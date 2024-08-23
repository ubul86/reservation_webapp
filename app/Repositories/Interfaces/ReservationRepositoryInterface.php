<?php

namespace App\Repositories\Interfaces;

interface ReservationRepositoryInterface
{
    public function getReservedTimesForDate(string $date): array;
}
