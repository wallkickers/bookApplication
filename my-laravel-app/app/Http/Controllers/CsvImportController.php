<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Book;

class CsvImportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // // アップロードファイルに対してのバリデート
        // $validator = $this->validateUploadFile($request);

        // if ($validator->fails() === true){
        //     return redirect('/form')->with('message', $validator->errors()->first('csv_file'));
        // }

        // CSVファイルをサーバーに保存
        $temporary_csv_file = $request->file('csv_file')->store('csv');

        $fp = fopen(storage_path('app/') . $temporary_csv_file, 'r');

        // 一行目（ヘッダ）読み込み
        $headers = fgetcsv($fp);
        $headers = explode("\t", $headers[0]);

        // dd($headers);
        $column_names = [];

        // CSVヘッダ確認
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
        $registration_csv_list    = [];
        $i = 0;

        // TODO:サイズが大きいCSVファイルを読み込む場合、この処理ではメモリ不足になる可能性がある為改修が必要になる
        while ($row = fgetcsv($fp)) {
            $rows = explode("\t", $row[0]);

            // Excelで編集されるのが多いと思うのでSJIS-win→UTF-8へエンコード
            // dat_book.csv はもともとUTF-8なので下記の変更は不必要
            // mb_convert_variables('UTF-8', 'SJIS-win', $row);
            // $is_registration_row = false;

            foreach ($column_names as $column_no => $column_name) {
                // dd($column_names, $column_no, $column_name, $rows,$rows[$column_no]);
                if ($column_name !== null) {
                    $registration_csv_list[$i][$column_name] = $rows[$column_no];
                }
            }
            // dd($registration_csv_list);

            // // バリデーションチェック
            // $validator = \Validator::make(
            //     $is_registration_row === true ? $registration_csv_list[$i] : $update_csv_list[$i],
            //     $this->defineValidationRules(),
            //     $this->defineValidationMessages()
            // );

            // if ($validator->fails() === true) {
            //     if ($is_registration_row === true) {
            //         $registration_errors_list[$i + 2] = $validator->errors()->all();
            //     } else {
            //         $update_errors_list[$i + 2] = $validator->errors()->all();
            //     }
            // }

            $i++;
        }

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

        foreach ($registration_csv_list as $key => $value) {
            $book = new Book();
            $book->fill(['book_name' => $value['title']]);
            $book->save();
        }

        // // 新規登録処理
        // if (isset($registration_csv_list) === true) {
        //     foreach ($registration_csv_list as $registration_csv) {
        //         // 登録処理
        //         if ($this->fill($registration_csv)->save() === false) {
        //             return redirect('/form')->with('message', '新規登録処理に失敗しました。');
        //         }
        //     }
        // }

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
