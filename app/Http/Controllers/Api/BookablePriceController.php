<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookablePriceController extends Controller
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
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from'
        ]);
        $bookable = Bookable::findOrFail($id);
        $from = Carbon::parse($data['from']);
        $to = Carbon::parse($data['to']);
        $diffInDays = $from->diffInDays($to) + 1;
        $totalPrice = $diffInDays * $bookable->price;
        return response()->json([
            'data' => [
                'price' => $totalPrice,
                'breakdown' => [
                    $bookable->price => $diffInDays
                ]
            ]
        ]);
    }
}
