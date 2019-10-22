<?php

namespace App\Http\Controllers\Admin;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(config('app.pagesize'));
        return view('admin.book.index')->with([
            'books' => $books
        ]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $book = Book::where('id', $bookId)->first();

        return view('admin.book.show',[
            'user' => $user,
            'book' => $book
        ]);
    }

    public function destroy(Request $request)
    {
        $bookId = $request->book;
        $deleteBook = Book::find($bookId);
        $deleteBook->delete();

        $books = Book::paginate(config('app.pagesize'));

        return view('admin.book.index')->with([
            'books' => $books
        ]);
    }
}
