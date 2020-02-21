<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;

class BookController extends Controller
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $searchedBooks = $this->book
            ->where('title_kana', 'LIKE', "%".$keyword."%")
            ->paginate(config('app.pagesize'));
        return view('book.home')->with([
            'books' => $searchedBooks
        ]);
     
    }

    public function index()
    {
        $books = $this->book
            ->orderBy('id', 'asc')
            ->paginate(config('app.pagesize'));

        return view('book.home')->with([
            'books' => $books
        ]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $book = $this->book
            ->find($bookId);

        return view('book.show',[
            'user' => $user,
            'book' => $book
        ]);
    }
}
