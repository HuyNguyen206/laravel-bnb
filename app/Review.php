<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    public $incrementing = false;
    protected $keyType = 'string';

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    function bookable()
    {
        return $this->belongsTo(Bookable::class, 'bookable_id');
    }

    function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
