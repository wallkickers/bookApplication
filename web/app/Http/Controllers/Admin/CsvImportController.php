<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Book;
use App\Http\Requests\StoreRequest;

class CsvImportController extends Controller
{
    public function create(){
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
        // CSVファイルをサーバーに保存
        $temporary_csv_file = $request->file('csv_file')->store('csv');

        $fp = fopen(storage_path('app/') . $temporary_csv_file, 'r');

        // 一行目（ヘッダ）読み込み
        $headers = fgetcsv($fp);
        if (count($headers)===1) {
            $headers = explode("\t", $headers[0]);
        }
        // dd($headers);

        // booksテーブルのカラムと一致する列名のみ取り出す
        $column_names = [];
        foreach ($headers as $header) {
            $result = Book::retrieveTestColumnsByValue($header, 'SJIS-win');
            $column_names[] = $result;
        }

        // 登録するデータが入る配列
        $registration_csv_list    = [];
        $i = 0;

        while (($data = fgetcsv($fp, 1000)) !== FALSE) {

            if (count($data)===1) {
                $data = explode("\t", $data[0]);
            }
            $num = count($data);

            for ($c=0; $c < $num; $c++) {
                if(!is_null($column_names[$c])){
                    $registration_csv_list[$i][$column_names[$c]] = $data[$c];
                }
            }
            $i++;
        }
        fclose($fp);

        // DB登録
        foreach ($registration_csv_list as $key => $value) {
            $book = new Book();
            $book -> fill($value);
            $book->save();
        }

        return redirect(route('admin.form'))->with('message', 'CSV登録が完了しました。' );
    }
}
