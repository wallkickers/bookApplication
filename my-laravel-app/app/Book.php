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
            'title' => "title",
            'title_kana' => "title_kana",
            'subtitle' => "subtitle",
            'subtitle_kana' => "subtitle_kana",
            'isbn' => "isbn",
            'author' => "author",
            'author_kana' => "author_kana",
            'publisher' => "publisher",
            'url' => "url",
        ];
        
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
