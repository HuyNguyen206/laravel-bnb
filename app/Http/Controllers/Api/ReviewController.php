<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewShowResource;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    function show($id)
    {
        return new ReviewShowResource(Review::findOrFail($id));
    }

    function store(Request $request)
    {
        $data =  $request->validate([
            'id' => 'required|size:36|unique:reviews',
            'content' => 'required|min:3',
            'rating' => 'required|in:1,2,3,4,5'
        ]);
        try {
            \DB::beginTransaction();
            $booking = Booking::getBookingByReviewKey($data['id']);
            if ($booking == null)
            {
                return abort(404, 'This booking already reviewed!');
            }
            $review = Review::make($data);
            $review->booking_id = $booking->id;
            $review->bookable_id = $booking->bookables_id;
            $review->save();
            $booking->review_key = '';
            $booking->save();
            \DB::commit();
            return new ReviewShowResource($review);
        }
        catch (\Throwable $ex)
        {
            \DB::rollBack();
            return response()->error($ex->getMessage(), $ex->getCode());
        }


    }
}
