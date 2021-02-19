<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    //
    function bookings()
    {
        return $this->hasMany(Booking::class, 'bookables_id');
    }

    function checkAvailability($from, $to)
    {
        return $this->bookings()->betweenDates($from, $to)->count() == 0;
    }

    function reviews()
    {
        return $this->hasMany(Review::class, 'bookable_id');
    }

    function priceFor($from, $to)
    {
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        $diffInDays = $from->diffInDays($to) + 1;
        $totalPrice = $diffInDays * $this->price;
        return  [
                'price' => $totalPrice,
                'breakdown' => [
                    $this->price => $diffInDays
                ]
            ];
    }
}
