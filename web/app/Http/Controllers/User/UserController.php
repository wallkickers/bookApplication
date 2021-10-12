<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function show()
    {
        $user = Auth::user();
        $userId = $user->id;
        $books = $this->bookService->getAllBooksByUserId($userId);

        return view('user.show', compact('user', 'books'));
    }
}
