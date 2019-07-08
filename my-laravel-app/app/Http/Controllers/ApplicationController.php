<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;

class ApplicationController extends Controller
{
    public function create(Request $request)
    {
        $bookId = $request->book;
        $book = Book::where('id', $bookId)->first();

        // 書籍の貸し出し申請
        return view('application.create')->with([
            'book' => $book
        ]);
    }

    public function store(Request $request)
    {
        return view('application.complete');
    }
}
