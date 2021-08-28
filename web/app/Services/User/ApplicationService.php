<?php

namespace App\Services\User;

use App\Book;
use App\RentalHistory;
use Carbon\Carbon;

class ApplicationService
{
    public function createHistory($bookId, $userId)
    {
        $nowDateTime = Carbon::now()->toDateTimeString();
        RentalHistory::create([
            'book_id' => $bookId,
            'rental_date' => $nowDateTime,
            'user_id' => $userId
        ])->save();
    }

    public function UpdateRentalDate($bookId)
    {
        $nowDateTime = Carbon::now()->toDateTimeString();
        $rentalHistory = RentalHistory::where([
            'book_id' => $bookId,
            'return_date' => null
        ])->first();
        $rentalHistory->update(['return_date' => $nowDateTime]);
    }
}
