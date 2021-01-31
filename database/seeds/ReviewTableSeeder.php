<?php

use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $bookables = \App\Bookable::all();
        $bookables->each(function($b){
            $b->reviews()->saveMany(factory(\App\Review::class, random_int(2, 3))->make());
        });
        $bookingIds = \App\Booking::all()->pluck('id');
        foreach (\App\Review::all() as $r)
        {
            $bookingId = $bookingIds->random();
            $bookingIds = $bookingIds->reject(function($value, $key) use($bookingId){
                return $value == $bookingId;
            });
            $r->booking_id = $bookingId;
            $r->save();
        }
    }
}
