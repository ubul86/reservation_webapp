<?php

namespace App\Repositories\Interfaces;

use App\Models\Place;
use Illuminate\Database\Eloquent\Collection;

interface PlaceRepositoryInterface
{
    /**
     * @return Collection<int, Place>
     */
    public function get(): Collection;
}
