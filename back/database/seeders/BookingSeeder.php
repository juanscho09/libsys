<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookings = [
            [
                'user_id' => 1,
                'book_id' => 1,
                'returned_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-03-01 15:20:45')->toDateTimeString(),
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-28 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 1,
                'book_id' => 2,
                'returned_book_at' => null,
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-28 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 2,
                'book_id' => 3,
                'returned_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-01-25 15:20:45')->toDateTimeString(),
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-01-01 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 2,
                'book_id' => 1,
                'returned_book_at' => null,
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-03-03 15:20:45')->toDateTimeString(),
                'reservation_date' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-28 15:20:45')->toDateTimeString(),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 2,
                'book_id' => 4,
                'returned_book_at' => null,
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-28 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 3,
                'book_id' => 5,
                'returned_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-05 15:20:45')->toDateTimeString(),
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-01-28 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 4,
                'book_id' => 1,
                'returned_book_at' => null,
                'borrowed_book_at' => null,
                'reservation_date' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-28 15:20:45')->toDateTimeString(),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 5,
                'book_id' => 5,
                'returned_book_at' => null,
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-03-01 15:20:45')->toDateTimeString(),
                'reservation_date' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-28 15:20:45')->toDateTimeString(),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 6,
                'book_id' => 7,
                'returned_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-12-19 15:20:45')->toDateTimeString(),
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-12-15 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 6,
                'book_id' => 8,
                'returned_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-12-19 15:20:45')->toDateTimeString(),
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-12-15 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 6,
                'book_id' => 5,
                'returned_book_at' => null,
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-06 15:20:45')->toDateTimeString(),
                'reservation_date' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-03-02 15:20:45')->toDateTimeString(),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 6,
                'book_id' => 11,
                'returned_book_at' => null,
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-03 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 6,
                'book_id' => 3,
                'returned_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-10 15:20:45')->toDateTimeString(),
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-03 15:20:45')->toDateTimeString(),
                'reservation_date' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-01-20 15:20:45')->toDateTimeString(),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 6,
                'book_id' => 15,
                'returned_book_at' => null,
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-03 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'user_id' => 6,
                'book_id' => 17,
                'returned_book_at' => null,
                'borrowed_book_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-03 15:20:45')->toDateTimeString(),
                'reservation_date' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        ];

        foreach ($bookings as $booking) {
            Booking::create([
                'user_id' => $booking['user_id'],
                'book_id' => $booking['book_id'],
                'returned_book_at' => $booking['returned_book_at'],
                'borrowed_book_at' => $booking['borrowed_book_at'],
                'reservation_date' => $booking['reservation_date'],
                'created_at' => $booking['created_at'],
                'updated_at' => $booking['updated_at']
            ]);
        }
    }
}
