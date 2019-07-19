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
        'book_name'
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
        // $a = "aaaaaa\taa,b";
        // $c = explode("\t", $a);
        // dd($a, $c);
        // dd($header);
        // $headers = explode("\t", $header);

        // dd($header);

        // CSVヘッダとテーブルのカラムを関連付けておく
        $list = [
            'title' => "title"
        ];

        // _id
        // parent_id
        // title
        // title_kana
        // subtitle
        // subtitle_kana
        // isbn
        // author
        // author_kana
        // publisher
        // size
        // series
        // series_kana
        // sales_date
        // price
        // url
        // aff_url
        // bdate
        // sd_conv
        // inmode
        // c_dtm
        // memo

        foreach ($list as $key => $value) {
            // dd($key, $value);
            if ($header === $value) {
                return $key;
            }

            // if ($headers[$key] === mb_convert_encoding($value, $encoding)) {
            //     dd($key);
            //     return $key;
            // }
        }
        return null;
        // return 'title';
    }
}
