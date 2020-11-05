<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalHistory extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id',
        'rental_date',
        'return_date',
        'user_id'
    ];

    /*
    該当書籍のBookモデルを返却
    */
    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    /*
    該当書籍のBookモデルを返却
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
