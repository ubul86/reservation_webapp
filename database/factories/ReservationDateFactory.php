<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReservationDate>
 */
class ReservationDateFactory extends Factory
{

    protected $model = \App\Models\ReservationDate::class;

    public function definition()
    {
        return [
            'date' => $this->faker->unique()->dateTimeBetween('-60 days', 'now')->format('Y-m-d'),
        ];
    }

}
