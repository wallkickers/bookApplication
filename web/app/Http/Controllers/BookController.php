<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\User\BookService;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $searchedBooks = $this->bookService
            ->searchByKeyword($keyword)
            ->paginate(config('app.pagesize'));
        return view('book.home')->with([
            'books' => $searchedBooks,
            'keyword' => $keyword
        ]);
    }

    public function index()
    {
        $books = $this->bookService
            ->getAllBooksOrderByIdAsc()
            ->paginate(config('app.pagesize'));

        return view('book.home')->with([
            'books' => $books
        ]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $book = $this->bookService
            ->findByBookId($bookId);

        return view('book.show',[
            'user' => $user,
            'book' => $book
        ]);
    }
}
