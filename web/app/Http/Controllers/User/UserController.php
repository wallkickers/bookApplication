<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function show()
    {
        $user = Auth::user();
        $userId = $user->id;
        $books = $this->book->getAllBooksByUserId($userId);

        return view('user.show', compact('user', 'books'));
    }
}
