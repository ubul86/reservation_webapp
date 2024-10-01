<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface PlaceRepositoryInterface
{
    public function get(): Collection;
}
