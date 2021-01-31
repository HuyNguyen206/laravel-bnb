<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingByReviewResource;
use Illuminate\Http\Request;

class BookingByReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($reviewKey, Request $request)
    {
        //
        $result = Booking::getBookingByReviewKey($reviewKey);
       return !empty($result) ? new BookingByReviewResource($result) : abort(404);
    }
}
