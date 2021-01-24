<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    function bookable()
    {
        return $this->belongsTo(Bookable::class, 'bookables_id');
    }
}
