<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Book;
use App\Http\Requests\StoreRequest;

class CsvImportController extends Controller
{
    public function create()
    {
        return view('admin.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $uploaded_file = $request->file('csv_file');
        $file_path = $uploaded_file->path($uploaded_file);

        $file = new \SplFileObject($file_path);
        $file->setFlags(\SplFileObject::READ_CSV);
        $file->setCsvControl("\t");

        $i = 0;
        $row_count = 0;
        $data = array();
        $column_names = [];
        $registration_csv_list = [];
        foreach ($file as $row) {
            // ヘッダー処理
            if ($row_count === 0) {
                $headers = $row;
                foreach ($headers as $header) {
                    // booksテーブルのカラムと一致する列名のみ取り出す
                    $result = Book::retrieveBookColumnsByValue($header, 'SJIS-win');
                    $column_names[] = $result;
                }
            }
            // データ処理
            if ($row_count > 0) {
                $data = $row;
                for ($c = 0; $c < count($data); $c++) {
                    if (!is_null($column_names[$c])) {
                        $registration_csv_list[$i][$column_names[$c]] = $data[$c];
                    }
                }
                $i++;
            }
            $row_count++;
        }
        // DB登録
        foreach ($registration_csv_list as $key => $value) {
            $book = new Book();
            $book->fill($value);
            $book->save();
        }

        return redirect(route('admin.form'))->with([
            'message' => 'CSV登録が完了しました。',
            'regist_book_count' => count($registration_csv_list)
        ]);
    }
}
