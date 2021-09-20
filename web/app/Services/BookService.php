<?php

declare(strict_types=1);

namespace App\Services;

use App\Book;
use App\RentalHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    /**
     * 書籍検索
     */
    public function searchByKeyword($keyword)
    {
        return Book::where('title_kana', 'LIKE', "%".$keyword."%");
    }

    /**
     * 全書籍取得
     */
    public function getAllBooksOrderByIdAsc()
    {
        return Book::orderBy('id', 'asc');
    }

    /**
     * 書籍取得
     */
    public function findByBookId($bookId)
    {
        return Book::find($bookId);
    }

    /**
     * 書籍情報更新
     */
    public function updateBookByParam(Book $book, $parameter=null)
    {
        $book->user_id = $parameter;
        $book->save();
    }

    /**
     * 書籍を借りている人の名前を返却
     */
    public function getAllBooksByUserId(int $userId): Collection
    {
        return Book::where('user_id', $userId)->get();
    }

    /**
     * 書籍削除
     */
    public function deleteByBookId(int $bookId): bool
    {
        $deleteBook = $this->findByBookId($bookId);
        return $deleteBook->delete();
    }

    /**
     * 書籍履歴取得
     */
    public function getAllBookHistoriesOrderByIdAsc(): Builder
    {
        return RentalHistory::orderBy('id', 'asc');
    }

    /**
     * TODO: const.php、Enum辺りで定数を定義
     * 書籍履歴取得_表示条件あり
     * @param string $display_item
     *   "return":返却済み
     *   "not_return":未返却
     */
    public function getBookHistoriesWithDisplayItemOrderByIdAsc($display_item): Builder
    {
        if ($display_item === "return") {
            $rental_histories = RentalHistory::whereNotNull("return_date");
        } elseif ($display_item === "not_return") {
            $rental_histories = RentalHistory::whereNull("return_date");
        }
        return $rental_histories->orderBy('id', 'asc');
    }
}
