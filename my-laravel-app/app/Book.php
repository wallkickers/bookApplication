<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Book extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_name', 
        'title_kana', 
        'subtitle', 
        'subtitle_kana', 
        'isbn', 
        'author', 
        'author_kana', 
        'publisher', 
        'url', 
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
            'book_name' => "title",
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
            if ($header === $value) {
                return $key;
            }
        }
        return null;
    }

    public function hasUserName(){
        $userId = $this->user_id;
        $userName = User::find($userId)->name;
        return $userName;
    }
}
