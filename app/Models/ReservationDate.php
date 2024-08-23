<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'reservation_dates';

    protected $fillable = ['date'];

    public function reservationTimes()
    {
        return $this->hasMany(ReservationTime::class);
    }
}
