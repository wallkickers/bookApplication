<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Services\BookService;
use App\Services\CsvImportService;

class CsvImportController extends Controller
{
    public function __construct(
        CsvImportService $csvImportService,
        BookService $bookService
    ){
        $this->csvImportService = $csvImportService;
        $this->bookService = $bookService;
    }

    /**
     * CSVインポート画面
     */
    public function create()
    {
        return view('admin.form');
    }

    /**
     * CSVデータ処理
     * @param  StoreRequest $request
     */
    public function store(StoreRequest $request)
    {
        $uploaded_file = $request->file('csv_file');
        $booksData = $this->csvImportService->CsvConvertToArray($uploaded_file);
        $this->bookService->registerBooks($booksData);

        return redirect(route('admin.form'))->with([
            'message' => 'CSV登録が完了しました。',
            'regist_book_count' => count($booksData)
        ]);
    }
}
