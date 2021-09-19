<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $books = $this->bookService
            ->searchByKeyword($keyword)
            ->paginate(config('app.pagesize'));
        return view('book.home', compact('books', 'keyword'));
    }

    public function index()
    {
        $books = $this->bookService
            ->getAllBooksOrderByIdAsc()
            ->paginate(config('app.pagesize'));

        return view('book.home', compact('books'));
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $book = $this->bookService->findByBookId($bookId);

        return view('book.show', compact('user', 'book'));
    }
}
