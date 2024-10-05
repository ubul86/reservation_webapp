<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PlaceRepositoryInterface;
use App\Repositories\PlaceRepository;
use Illuminate\Http\JsonResponse;

class PlaceController extends Controller
{
    protected PlaceRepositoryInterface $placeRepository;

    public function __construct(PlaceRepositoryInterface $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    public function getPlaces(): JsonResponse
    {
        $places = $this->placeRepository->get();

        return response()->json($places);
    }
}
