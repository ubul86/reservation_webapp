<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ReservationRepositoryInterface;
use App\Repositories\ReservationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected ReservationRepository $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function index(Request $request, ?string $date = null): JsonResponse
    {
        if (!$date) {
            $date = now()->format('Y-m-d');
        }

        $reservedTimes = $this->reservationRepository->getReservedTimesForDate($date);

        return response()->json($reservedTimes);
    }

    public function bulkStore(Request $request): JsonResponse
    {

        $reservations = $request->post();
        $storedReservations = [];
        foreach ($reservations as $reservation) {
            $storedReservations[] = $this->reservationRepository->storeSelectedReservation($reservation);
        }

        return response()->json($storedReservations);
    }

}
