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
        return view('application.create', [
            'book' => $book
        ]);
    }

    public function store(Request $request)
    {
        // 何かの処理
        $user = Auth::user();
        $bookId = $request->book;
        $book = Book::where('id', $bookId)->first();
        $book->user_id = $user->id;
        $book->save();

        // \Slack::send('貸し出し申請がありました。名前：'.$user->name.' 書籍名：'.$book->book_name.'：URL:'.env('APP_URL').'/books/'.$book->id);
        return view('application.complete');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->application;
        $book = Book::where('id', $bookId)->first();
        $book->user_id = null;
        $book->save();
        // \Slack::send('本が返却されました。名前：'.$user->name.' 書籍名：'.$book->book_name.'：URL:'.env('APP_URL').'/books/'.$book->id);
        return view('application.complete');
    }    
}
