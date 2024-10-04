<?php

namespace App\Repositories;

use App\Models\ReservationDate;
use App\Models\ReservationTime;
use Illuminate\Support\Carbon;
use App\Repositories\Interfaces\ReservationRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

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
                return $reservation->getTransformedArray();
            })
            ->toArray();

        return $reservedTimes;
    }

    public function storeSelectedReservation(array $reservation): array
    {
        $user = JWTAuth::parseToken()->authenticate();

        $reservationDate = ReservationDate::firstOrCreate(
            ['date' => $reservation['date']]
        );

        $newReservation = ReservationTime::create([
            'user_id' => $user->id,
            'reservation_date_id' => $reservationDate->id,
            'place_id' => $reservation['placeId'],
            'hour' => $reservation['hour']
        ]);

        return $newReservation->getTransformedArray();
    }

    public function delete(int $id): bool
    {
        try{
            $reservation = ReservationTime::findOrFail($id);
            $reservation->delete();
            return true;
        }
        catch(\Exception $e) {
            return false;
        }
    }

}
