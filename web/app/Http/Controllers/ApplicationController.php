<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\User\BookService;
use App\Services\User\ApplicationService;
use App\Services\Slack\SlackService;

class ApplicationController extends Controller
{
    private $bookService;
    private $applicationService;
    private $slackService;

    public function __construct(
        BookService $bookService,
        ApplicationService $applicationService,
        SlackService $slackService
    )
    {
        $this->bookService = $bookService;
        $this->applicationService = $applicationService;
        $this->slackService = $slackService;
    }

    public function create(Request $request)
    {
        $bookId = $request->book;
        $book = $this->bookService->findByBookId($bookId);

        // 書籍の貸し出し申請
        return view('application.create', ['book' => $book]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $userId = $user->id;

        // booksテーブルの所有者をuser_idで更新
        $book = $this->bookService->findByBookId($bookId);
        $this->bookService->updateBookByParam($book, $userId);

        // 貸出時にrental_hitoryテーブルを追加
        $this->applicationService->createHistory($bookId, $userId);

        $this->slackService->send(
            '貸し出し申請がありました。名前：' . $user->name . ' 書籍名：' . $book->book_name . '：URL:' . env('APP_URL') . '/books/' . $book->id
        );
        return view('application.complete')->with(['message' => '貸し出し完了']);
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->application;

        // booksテーブルの所有者をnullで更新
        $book = $this->bookService->findByBookId($bookId);
        $this->bookService->updateBookByParam($book, null);

        // 返却時に該当のrental_hitoryテーブルを更新
        $this->applicationService->UpdateRentalDate($bookId);

        $this->slackService->send(
            '本が返却されました。名前：' . $user->name . ' 書籍名：' . $book->book_name . '：URL:' . env('APP_URL') . '/books/' . $book->id
        );
        return view('application.complete')->with(['message' => '返却完了']);
    }
}
