<?php

namespace App\Http\Controllers\Admin;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Book;
use Thinreports;

class PdfController extends Controller
{
    public function show(){
        // data取得
        $books = Book::all();
        // パス
        $path = app_path('Reports/bookList.tlf');
        // 雛形ファイル読み込み
        $report = new Thinreports\Report($path);

        foreach ($books as $book) {
            // ページ作成
            $page = $report->addPage();
            $page->setItemValues([
                'id' => $book->id,
                'book_name' => $book->book_name
            ]);
        }

        // ブラウザへ表示
        return \Response::make($report->generate(), 200, [
                  'Content-Type' => 'application/pdf',
                  'Content-Disposition' => "inline; filename=book_list.pdf"
              ]);
      }
}
