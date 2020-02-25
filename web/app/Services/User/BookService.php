<?php
namespace App\Services\User;

use App\Book;

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

    public function getAllBooksByUserId($userId)
    {
        return Book::where('user_id', $userId)->get();
    }

    public function findByBookId($bookId)
    {
        return Book::find($bookId);
    }
}
