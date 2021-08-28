<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public static function retrieveBookColumnsByValue(string $header)
    {
        // CSVファイルのヘッダとテーブルカラムの関連付け
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

    /*
    書籍を借りている人のUserモデルを返却
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
    書籍を借りている人の名前を返却
    */
    public function hasUserName()
    {
        if ($this->user_id) {
            $userId = $this->user_id;
            $userName = User::find($userId)->name;
            return $userName;
        } else {
            return null;
        }
    }
}
