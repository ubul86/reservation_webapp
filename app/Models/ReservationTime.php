<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    /**
     * @return BelongsTo<User, ReservationTime>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<ReservationDate, ReservationTime>
     */
    public function reservationDate(): BelongsTo
    {
        return $this->belongsTo(ReservationDate::class);
    }

    /**
     * @return BelongsTo<Place, ReservationTime>
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function getTransformedArray(): array
    {
        return [
            'hour' => $this->hour,
            'place' => $this->place->name,
            'place_id' => $this->place->id,
            'user' => $this->user->name,
            'user_id' => $this->user->id,
            'reservation_date' => $this->reservationDate->date,
        ];
    }

}
