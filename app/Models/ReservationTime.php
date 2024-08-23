<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationTime extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $table = 'reservation_times';

    protected $fillable = [
        'user_id',
        'reservation_date_id',
        'place_id',
        'hour'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservationDate()
    {
        return $this->belongsTo(ReservationDate::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
