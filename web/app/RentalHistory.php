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
    ];

    /*
    該当書籍のBookモデルを返却
    */
    public function book(){
        return belongsTo('App\Book');
    }
}
