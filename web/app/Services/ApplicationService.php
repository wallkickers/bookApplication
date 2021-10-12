<?php

declare(strict_types=1);

namespace App\Services;

use App\Book;
use App\RentalHistory;
use App\Services\Slack\SlackService;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApplicationService
{
    private $bookService;
    private $slackService;

    public function __construct(
        BookService $bookService,
        SlackService $slackService
    ) {
        $this->bookService = $bookService;
        $this->slackService = $slackService;
    }

    /**
     * 書籍の貸出し処理
     * @param Book $book 書籍
     * @param User $user ユーザー
     */
    public function bookLending(Book $book, User $user)
    {
        DB::transaction(function () use ($book, $user) {
            $this->bookService->updateBookByParam($book, $user->id);
            $this->createHistory($book->id, $user->id);
        });

        $lendingMessage = "貸し出し申請がありました。名前：{$user->name} 書籍名：{$book->book_name}";
        $this->slackService->send($lendingMessage);
    }

    /**
     * 書籍の返却処理
     * @param Book $book 書籍
     * @param User $user ユーザー
     */
    public function bookReturned(Book $book, User $user)
    {
        DB::transaction(function () use ($book) {
            $this->bookService->updateBookByParam($book, null);
            $this->UpdateRentalDate($book->id);
        });

        $returnedMessage = "本が返却されました。名前：{$user->name} 書籍名：{$book->book_name}";
        $this->slackService->send($returnedMessage);
    }

    /**
     * 貸出履歴作成
     * @param int $bookId 書籍ID
     * @param int $userId ユーザーID
     */
    private function createHistory(int $bookId, int $userId)
    {
        $nowDateTime = Carbon::now()->toDateTimeString();
        RentalHistory::create([
            'book_id' => $bookId,
            'rental_date' => $nowDateTime,
            'user_id' => $userId
        ])->save();
    }

    /**
     * 貸出履歴作成
     * @param int $bookId 書籍ID
     */
    private function UpdateRentalDate(int $bookId)
    {
        $nowDateTime = Carbon::now()->toDateTimeString();
        $rentalHistory = RentalHistory::where([
            'book_id' => $bookId,
            'return_date' => null
        ])->first();
        $rentalHistory->update(['return_date' => $nowDateTime]);
    }
}
