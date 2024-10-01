<?php

namespace App\Repositories;

use App\Models\ReservationTime;
use Illuminate\Support\Carbon;
use App\Repositories\Interfaces\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    /**
     * Get all reserved times for a given date.
     *
     * @param string $date
     * @return array
     */
    public function getReservedTimesForDate(string $date): array
    {
        $date = Carbon::parse($date)->format('Y-m-d');

        $reservedTimes = ReservationTime::whereHas('reservationDate', function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
            ->with('place', 'user', 'reservationDate')
            ->get()
            ->map(function ($reservation) {
                return [
                    'hour' => $reservation->hour,
                    'place' => $reservation->place->name,
                    'place_id' => $reservation->place->id,
                    'user' => $reservation->user->name,
                    'reservation_date' => $reservation->reservationDate->date,
                ];
            })
            ->toArray();

        return $reservedTimes;
    }
}
