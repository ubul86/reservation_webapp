<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ReservationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class ReservationController extends Controller
{
    protected ReservationRepositoryInterface $reservationRepository;

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

        $reservations = $request->all();
        $storedReservations = [];
        foreach ($reservations as $reservation) {
            $storedReservations[] = $this->reservationRepository->storeSelectedReservation($reservation);
        }

        return response()->json($storedReservations);
    }

    public function delete(int $id): JsonResponse
    {
        $result = $this->reservationRepository->delete($id);

        if (!$result) {
            throw new RuntimeException('Error', 500);
        }

        return response()->json(['message' => 'Successfully deleted reservation']);
    }
}
