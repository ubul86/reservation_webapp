<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{

    protected $model = \App\Models\Place::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company()
        ];
    }

}
