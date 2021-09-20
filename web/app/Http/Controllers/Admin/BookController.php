<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

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

    /**
     * 書籍一覧
     */
    public function index()
    {
        $books = $this->bookService
            ->getAllBooksOrderByIdAsc()
            ->paginate(config('app.pagesize'));
        return view('admin.book.index', compact('books'));
    }

    /**
     * 書籍詳細
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $book = $this->bookService->findByBookId($bookId);

        return view('admin.book.show', compact('user', 'book'));
    }

    /**
     * 書籍削除
     */
    public function destroy(Request $request)
    {
        $bookId = $request->book;
        $this->bookService->deleteByBookId($bookId);

        return redirect()->route('admin.books.index');
    }

    /**
     * 書籍履歴
     */
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

        return view('admin.rental_histories.index', compact('rental_histories', 'display_item'));
    }
}
