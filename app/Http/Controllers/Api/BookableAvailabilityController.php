<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        //
        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d|after:today',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from'
        ]);
        $booking = Bookable::findOrFail($id);
        return $booking->checkAvailability($data['from'], $data['to']) ?
        response()->json([]) :
        response()->json([], 404);

        dd($booking);
    }
}
