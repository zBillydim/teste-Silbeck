<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomReservation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_room',
        'id_user',
        'id_hotel',
        'checkin',
        'checkout',
        'status',
        'total_price',
        'unit_price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'checkin' => 'date',
        'checkout' => 'date',
        'status' => 'string',
        'total_price' => 'float',
        'unit_price' => 'float',
    ];

    /**
     * Get the room associated with the reservation.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'id_room');
    }

    /**
     * Get the user who made the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the hotel associated with the reservation.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel');
    }
}
