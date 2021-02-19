<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Bookable;
use App\Booking;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CheckoutRequest $request)
    {
        $vaidatedData = $request->validated();
        $finalData = array_merge($vaidatedData, $request->validate([
            'bookings.*' => ['required', function ($attribute, $value, $fail) {
                $bookable = Bookable::find($value['bookables_id']);
                if (!$bookable->checkAvailability($value['from'], $value['to'])) {
                    $fail('The bookable is not available in given dates!');
                }
            }]
        ]));
        $address = $finalData['customer'];
        $bookings = $finalData['bookings'];
        $bookingsCollection = collect($bookings);
        $dataReturn = $bookingsCollection->map(function ($booking) use ($address) {
            $bookable = Bookable::findOrFail($booking['bookables_id']);
            $totalPrice = $bookable->priceFor($booking['from'], $booking['to'])['price'];
            $booking['price'] = $totalPrice;
            $newBooking = Booking::create($booking);
            $newBooking->address()->associate(Address::create($address));
            $newBooking->save();
            return $newBooking->load('bookable');
        });
        return $dataReturn;
    }
}
