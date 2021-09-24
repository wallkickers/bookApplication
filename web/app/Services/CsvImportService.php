<?php

declare(strict_types=1);

namespace App\Services;

use App\Book;
use Illuminate\Http\UploadedFile;
use SplFileObject;

class CsvImportService
{
    public function CsvConvertToArray(UploadedFile $file): array
    {
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $file_path = $file->path($file);
        $file = new SplFileObject($file_path);
        $file->setFlags(SplFileObject::READ_CSV);
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
        return $registration_csv_list;
    }
}
