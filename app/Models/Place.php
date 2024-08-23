<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';

    public $timestamps = false;

    protected $fillable = ['name'];

    /**
     * @return HasMany<ReservationTime>
     */
    public function reservationTimes(): HasMany
    {
        return $this->hasMany(ReservationTime::class);
    }
}
