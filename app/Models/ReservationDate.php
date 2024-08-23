<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReservationDate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'reservation_dates';

    protected $fillable = ['date'];

    /**
     * @return HasMany<ReservationTime>
     */
    public function reservationTimes(): HasMany
    {
        return $this->hasMany(ReservationTime::class);
    }
}
