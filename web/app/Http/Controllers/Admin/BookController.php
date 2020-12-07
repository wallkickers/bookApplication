<?php

namespace App\Http\Controllers\Admin;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Admin\BookService;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService
            ->getAllBooksOrderByIdAsc()
            ->paginate(config('app.pagesize'));
        return view('admin.book.index')->with([
            'books' => $books
        ]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $book = $this->bookService
            ->findByBookId($bookId);

        return view('admin.book.show', [
            'user' => $user,
            'book' => $book
        ]);
    }

    public function destroy(Request $request)
    {
        $bookId = $request->book;
        $result = $this->bookService->deleteByBookId($bookId);

        return redirect()->route('admin.books.index');
    }

    public function history(Request $request)
    {
        $display_item = $request->display_item;
        if (is_null($display_item)) {
            $rental_histories = $this->bookService
                ->getAllBookHistoriesOrderByIdAsc();
        } else {
            $rental_histories = $this->bookService
                ->getBookHistoriesWithDisplayItemOrderByIdAsc($request->display_item);
        }

        $rental_histories = $rental_histories->paginate(config('app.pagesize'));

        return view('admin.rental_histories.index')
            ->with([
                'rental_histories' => $rental_histories,
                'display_item' => $display_item,
            ]);
    }
}
