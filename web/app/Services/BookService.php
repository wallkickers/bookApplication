<?php

declare(strict_types=1);

namespace App\Services;

use App\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    public function searchByKeyword($keyword)
    {
        return Book::where('title_kana', 'LIKE', "%".$keyword."%");
    }

    public function getAllBooksOrderByIdAsc()
    {
        return Book::orderBy('id', 'asc');
    }

    public function findByBookId($bookId)
    {
        return Book::find($bookId);
    }

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
}
