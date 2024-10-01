<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Place;
use App\Models\ReservationTime;
use App\Models\ReservationDate;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(10)->create();
        Place::factory(5)->create();
        ReservationDate::factory(10)->create();

        ReservationTime::factory(50)->create();

    }
}
