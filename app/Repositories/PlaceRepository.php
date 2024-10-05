<?php

namespace App\Repositories;

use App\Models\Place;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PlaceRepository implements PlaceRepositoryInterface
{
    /**
     * @return Collection<int, Place>
     */
    public function get(): Collection
    {
        return Place::all();
    }
}
