<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Place;
use App\Models\ReservationDate;
use App\Models\ReservationTime;

class ReservationTimeFactory extends Factory
{
    protected $model = ReservationTime::class;

    public function definition()
    {
        do {
            $userId = User::inRandomOrder()->first()->id;
            $placeId = Place::inRandomOrder()->first()->id;
            $reservationDateId = ReservationDate::inRandomOrder()->first()->id;
            $hour = $this->faker->numberBetween(8, 20);
        } while (ReservationTime::where('user_id', $userId)
            ->where('place_id', $placeId)
            ->where('reservation_date_id', $reservationDateId)
            ->where('hour', $hour)
            ->exists());

        return [
            'user_id' => $userId,
            'place_id' => $placeId,
            'reservation_date_id' => $reservationDateId,
            'hour' => $hour,
        ];
    }
}
