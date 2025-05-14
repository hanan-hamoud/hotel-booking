<?php

namespace App\Models;
use App\Enums\RoomStatus;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'check_in_date',
        'check_out_date',
        'special_request',
        'status',
    ];

    protected $casts = [
        'status' => RoomStatus::class,
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function hotel()
    {
        return optional($this->room)->hotel;
    }

  
}
