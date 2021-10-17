<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\ApplicationService;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    private $bookService;
    private $applicationService;

    public function __construct(
        BookService $bookService,
        ApplicationService $applicationService
    ) {
        $this->bookService = $bookService;
        $this->applicationService = $applicationService;
    }

    /**
     * 書籍の貸出し・返却ページ表示
     */
    public function create(Request $request)
    {
        $bookId = $request->book;
        $book = $this->bookService->findByBookId($bookId);

        return view('application.create', compact('book'));
    }

    /**
     * 書籍の貸出し処理
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->book;
        $message = '貸し出し完了';

        $book = $this->bookService->findByBookId($bookId);
        $this->applicationService->bookLending($book, $user);

        return view('application.complete', compact('message'));
    }

    /**
     * 書籍の返却処理
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->application;
        $message = '返却完了';

        $book = $this->bookService->findByBookId($bookId);
        $this->applicationService->bookReturned($book, $user);

        return view('application.complete', compact('message'));
    }
}
