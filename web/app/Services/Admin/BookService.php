<?php

namespace App\Services\Admin;

use App\Book;
use App\RentalHistory;

class BookService
{
    public function searchByKeyword($keyword)
    {
        return Book::where('title_kana', 'LIKE', "%" . $keyword . "%");
    }

    public function getAllBooksOrderByIdAsc()
    {
        return Book::orderBy('id', 'asc');
    }

    public function findByBookId($bookId)
    {
        return Book::find($bookId);
    }

    public function deleteByBookId($bookId)
    {
        $deleteBook = $this->findByBookId($bookId);
        return $deleteBook->delete();
    }

    public function getAllBookHistoriesOrderByIdAsc()
    {
        return RentalHistory::orderBy('id', 'asc');
    }
}
