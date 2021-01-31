<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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

   protected static function booted()
   {
       static::creating(function($booking){
        $booking->review_key = Str::uuid();
       });
   }

   public static function getBookingByReviewKey($reviewKey)
   {
       return static::where('review_key', $reviewKey)->with('bookable')->first();
   }
}
