<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Book;

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
    public function store(Request $request)
    {
        // CSVファイルをサーバーに保存
        $temporary_csv_file = $request->file('csv_file')->store('csv');

        $fp = fopen(storage_path('app/') . $temporary_csv_file, 'r');

        // 一行目（ヘッダ）読み込み
        $headers = fgetcsv($fp);
        $headers = explode("\t", $headers[0]);

        // dd($headers);
        
        // booksのカラムと一致する列名のみ取り出す
        $column_names = [];
        foreach ($headers as $header) {
            $result = Book::retrieveTestColumnsByValue($header, 'SJIS-win');
            // if ($result === null) {
            //     fclose($fp);
            //     Storage::delete($temporary_csv_file);
            //     return redirect('/form')
            //         ->with('message', '登録に失敗しました。CSVファイルのフォーマットが正しいことを確認してださい。');
            // }
            $column_names[] = $result;
        }

        // dd($column_names);

        $registration_errors_list = [];
        $update_errors_list       = [];

        // 登録するデータが入る配列
        $registration_csv_list    = [];
        $i = 0;

        // $row = fgetcsv($fp);
        // dd($row);

        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {

            $data = explode("\t", $data[0]);
            $num = count($data);

            for ($c=0; $c < $num; $c++) {
                if(!is_null($column_names[$c])){
                    $registration_csv_list[$i][$column_names[$c]] = $data[$c];
                }
            }
            $i++;
        }
        fclose($fp);


        // TODO: サイズが大きいCSVファイルを読み込む場合、この処理ではメモリ不足になる可能性がある為改修が必要
        // for($i=0; $i<2; $i++)
        // while (($row = fgetcsv($fp, 1000, ",")) !== FALSE) {
        //     // 入力値の列を読み込む
        //     $rows = explode("\t", $row[0]);

        //     // dd($rows[9]);

        //     // Tips: 文字コードの変換が必要な場合
        //     // Excelで編集されるのが多いと思うのでSJIS-win→UTF-8へエンコード
        //     // dat_book.csv はもともとUTF-8なので下記の変更は不必要
        //     // mb_convert_variables('UTF-8', 'SJIS-win', $row);
        //     // $is_registration_row = false;

        //     // dd($column_names, $rows);

        //     foreach ($column_names as $column_no => $column_name) {
        //         if (!is_null($column_name)) {
        //         //    if ($column_no == 10) {
        //         //         var_dump($rows[$column_no]);
        //         //         $registration_csv_list[$i][$column_name] = $rows[$column_no];
        //         //         dd($column_no, $rows[$column_no]);

        //         //     }
        //             $registration_csv_list[$i][$column_name] = $rows[$column_no];
        //         }
        //     }
        //     dd($registration_csv_list);
        //     $i++;
        // }

        // dd($registration_csv_list);

        // // バリデーションエラーチェック
        // if (count($registration_errors_list) > 0 || count($update_errors_list) > 0) {
        //     return redirect('/form')
        //         ->with('errors', ['registration_errors' => $registration_errors_list, 'update_errors' => $update_errors_list]);
        // }

        // // 既存更新処理
        // if (isset($update_csv_list) === true) {
        //     foreach ($update_csv_list as $update_csv) {
        //         // ～更新用の処理～
        //         if ($this->fill($update_csv)->save() === false) {
        //             return redirect('/form')
        //                 ->with('message', '既存データの更新に失敗しました。（新規登録処理は行われずに終了しました）');
        //         }
        //     }
        // }

        // $book = new Book();
        // $book->fill($registration_csv_list);
        // $book->save();

        // DB登録
        foreach ($registration_csv_list as $key => $value) {
            $book = new Book();
            $book -> fill($value);
            $book->save();
        }

        return redirect('/form')->with('message', 'CSV登録が完了しました。' );
    }

    /**
     * バリデーションの定義
     *
     * @return array
     */
    private function defineValidationRules()
    {
        return [
            // CSVデータ用バリデーションルール
            'content' => 'required',
        ];
    }

    /**
     * バリデーションメッセージの定義
     *
     * @return array
     */
    private function defineValidationMessages()
    {
        return [
            // CSVデータ用バリデーションエラーメッセージ
            'content.required' => '内容を入力してください。',
        ];
    }
}
