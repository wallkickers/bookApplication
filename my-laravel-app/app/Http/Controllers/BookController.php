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
        $books = Book::all();
        
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
