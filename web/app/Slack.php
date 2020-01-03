<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Book;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Slack extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon', 'channel', 'url'
    ];

    // slacksテーブルには日付カラムが存在しないことを明示
    public $timestamps = false;
}
