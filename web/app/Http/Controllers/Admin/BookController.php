<?php

namespace App\Http\Controllers\Admin;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Book;

class BookController extends Controller
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        $books = $this->book
            ->orderBy('id', 'asc')
            ->paginate(config('app.pagesize'));
        return view('admin.book.index')->with([
            'books' => $books
        ]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $book = $this->book->find($bookId);

        return view('admin.book.show',[
            'user' => $user,
            'book' => $book
        ]);
    }

    public function destroy(Request $request)
    {
        $bookId = $request->book;
        $deleteBook = $this->book->find($bookId);
        $deleteBook->delete();

        return redirect()->route('admin.books.index');
    }
}
