<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\RentalHistory;
use Carbon\Carbon;

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
        $user = Auth::user();
        $bookId = $request->book;

        // booksテーブルの所有者をuser_idで更新
        $book = Book::where('id', $bookId)->first();
        $book->user_id = $user->id;
        $book->save();

        // 貸出時にrental_hitoryテーブルを追加
        RentalHistory::create(['book_id' => $bookId])->save();

        \Slack::send('貸し出し申請がありました。名前：'.$user->name.' 書籍名：'.$book->book_name.'：URL:'.env('APP_URL').'/books/'.$book->id);
        return view('application.complete')->with(['message'=>'貸し出し完了']);
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->application;

        // booksテーブルの所有者をnullで更新
        $book = Book::find($bookId)->first();
        $book->user_id = null;
        $book->save();

        // 返却時に該当のrental_hitoryテーブルを更新
        $rentalHistory = RentalHistory::where(['book_id' => $bookId, 'return_date' => null])->first();
        $nowDateTime = Carbon::now()->toDateTimeString();
        $rentalHistory->update(['return_date' => $nowDateTime]);

        \Slack::send('本が返却されました。名前：'.$user->name.' 書籍名：'.$book->book_name.'：URL:'.env('APP_URL').'/books/'.$book->id);
        return view('application.complete')->with(['message'=>'返却完了']);;
    }    
}
