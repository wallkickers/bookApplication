<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $query = Book::query();
        $searchedBooks = $query
            ->where('title_kana', 'LIKE', "%".$keyword."%")
            ->paginate(config('app.pagesize'));
        return view('book.home')->with([
            'books' => $searchedBooks,
            'keyword' => $keyword
        ]);
     
    }

    public function index()
    {
        $books = Book::orderBy('id', 'asc')
            ->paginate(config('app.pagesize'));

        return view('book.home')->with([
            'books' => $books
        ]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $book = Book::where('id', $bookId)->first();

        return view('book.show',[
            'user' => $user,
            'book' => $book
        ]);
    }
}
