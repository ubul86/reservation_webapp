<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReservationTime>
 */
class ReservationTimeFactory extends Factory
{

    protected $model = \App\Models\ReservationTime::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'reservation_date_id' => \App\Models\ReservationDate::factory(),
            'place_id' => \App\Models\Place::factory(),
            'hour' => $this->faker->numberBetween(8, 20),
        ];
    }

}
