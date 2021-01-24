<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    //
    function bookings()
    {
        return $this->hasMany(Booking::class, 'bookables_id');
    }
}