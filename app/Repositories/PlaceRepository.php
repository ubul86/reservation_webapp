<?php

namespace App\Repositories;

use App\Models\Place;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PlaceRepository implements PlaceRepositoryInterface
{
    public function get(): Collection
    {
        return Place::all();
    }
}
