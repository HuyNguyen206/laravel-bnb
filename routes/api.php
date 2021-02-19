<?php

use App\Bookable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('Api')->group(function(){
    Route::apiResource('bookables', 'BookableController');
    Route::get('bookables/{bookable}/availability', 'BookableAvailabilityController')->name('bookables.available');
    Route::get('bookables/{bookable}/review', 'BookableReviewController')->name('bookables.reviews.index');
    Route::apiResource('reviews', 'ReviewController')->only(['show', 'store']);
    Route::get('booking-by-review/{reviewKey}', 'BookingByReviewController');
    Route::get('bookables/{bookables}/price', 'BookablePriceController')->name('bookable.price.show');
    Route::post('checkout', 'CheckoutController')->name('checkout');
});

//Route::get('bookables', function (){
//    return Bookable::all();
//});
//Route::get('bookables/{id}', function ($id){
//    return Bookable::find($id);
//});
