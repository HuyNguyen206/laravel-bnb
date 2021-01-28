<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Booking extends Model
{
    //
    function bookable()
    {
        return $this->belongsTo(Bookable::class, 'bookables_id');
    }

    function scopeBetweenDates($query, $from, $to)
    {
        return $query->where('to', '>=', $from)
            ->where('from', '<=', $to);
//        return $query->where('to', '>=', $from)
//            ->where('to', '<=', $to)
//            ->orWhere(function(Builder $q) use($from, $to){
//                $q->where('from', '>=', $from)
//                    ->where('from', '<=', $to);
//            });
    }

    function review()
    {
        return $this->hasOne(Review::class, 'booking_id');
    }
}
