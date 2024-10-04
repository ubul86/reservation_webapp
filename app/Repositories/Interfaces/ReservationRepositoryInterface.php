<?php

namespace App\Repositories\Interfaces;

interface ReservationRepositoryInterface
{
    public function getReservedTimesForDate(string $date): array;

    public function storeSelectedReservation(array $reservation): array;

    public function delete(int $id): bool;

}
