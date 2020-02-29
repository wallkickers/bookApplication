<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Support\Facades\Auth;
use App\Services\User\BookService;

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
        $books = $this->bookService
            ->getAllBooksByUserId($userId);

        return view('user.show',[
            'user' => $user,
            'books' => $books
        ]);
    }
}
