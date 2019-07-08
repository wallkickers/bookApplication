<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * CSVヘッダ項目の定義値があれば定義配列のkeyを返す   
     *
     * @param string $header
     * @param string $encoding
     * @return string|null
     */
    public static function retrieveTestColumnsByValue(string $header ,string $encoding)
    {
        // CSVヘッダとテーブルのカラムを関連付けておく
        $list = [
            'content' => "内容",
            'memo'    => "備考",
        ];

        foreach ($list as $key => $value) {
            if ($header === mb_convert_encoding($value, $encoding)) {
                return $key;
            }
        }
        return null;
    }
}
