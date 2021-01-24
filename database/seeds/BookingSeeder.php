<?php

use App\Bookable;
use App\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $bookables = Bookable::all();
        $bookables->each(function ($bookable){
            $randomBooking = random_int(2, 5);
            for($i = 0; $i < $randomBooking; $i++)
            {
                $bookDraft = factory(Booking::class)->make();
                $bookDraft->from = $i == 0 ? (clone $bookDraft->to)->addDays($randomBooking) : (clone $to)->addDays($randomBooking);
                $bookDraft->to =   (clone $bookDraft->from)->addDays($randomBooking);
                $bookable->bookings()->save($bookDraft);
                $to = $bookDraft->to;

            }
        });
    }
}
