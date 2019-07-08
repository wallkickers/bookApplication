<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;

class BookController extends Controller
{
    public function index()
    {
        // csvからインポート
        // $reader = new Reader();
        // $spreadsheet = $reader->load('dat_book.csv');

        $books = Book::all();

        return view('home')->with([
            'books' => $books
        ]);
    }

    public function show(Request $request)
    {
        $bookId = $request->book;
        $book = Book::where('id', $bookId)->first();

        return view('show')->with([
            'book' => $book
        ]);
    }
}
