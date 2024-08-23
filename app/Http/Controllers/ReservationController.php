<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ReservationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $date = $request->query('date', now()->format('Y-m-d'));
        $reservedTimes = $this->reservationRepository->getReservedTimesForDate($date);

        return response()->json($reservedTimes);
    }
}
