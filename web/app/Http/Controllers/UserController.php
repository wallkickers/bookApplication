<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $books = Book::where('user_id', $userId)->get();

        return view('user.show',[
            'user' => $user,
            'books' => $books
        ]);
    }
}
