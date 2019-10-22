<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\RentalHistory;
use Faker\Provider\zh_TW\DateTime;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;
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
        $book = Book::where('id', $bookId)->first();
        $book->user_id = $user->id;
        $book->save();

        // 貸出履歴としてrental_hitoryテーブルにレコード追加
        $rentalHistory = RentalHistory::create(['book_id' => $bookId]);

        \Slack::send('貸し出し申請がありました。名前：'.$user->name.' 書籍名：'.$book->book_name.'：URL:'.env('APP_URL').'/books/'.$book->id);
        return view('application.complete');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->application;
        $book = Book::where('id', $bookId)->first();
        $book->user_id = null;
        $book->save();

        // 返却履歴としてrental_hitoryテーブルにレコード追加
        $rentalHistory = RentalHistory::where(['book_id' => $bookId, 'return_date' => null])->first();

        // TODO: 返却日時を入れようとすると、更新ではなく、レコードが追加されてしまう。
        // TODO: 現在の日時がtimestampになっているのか。
        // TODO: タイムゾーンの設定
        dd($rentalHistory);
        $rentalHistory->return_date = Carbon::now();
        $rentalHistory->save();

        \Slack::send('本が返却されました。名前：'.$user->name.' 書籍名：'.$book->book_name.'：URL:'.env('APP_URL').'/books/'.$book->id);
        return view('application.complete');
    }    
}
