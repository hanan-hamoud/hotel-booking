<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\RoomType;
use App\Enums\RoomStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
        'room_number',
        'room_type',
        'price_per_night',
        'status',
    ];

    protected $casts = [
        'room_type' => RoomType::class,
        'status' => RoomStatus::class,
    ];

    // ✅ العلاقة الصحيحة مع الفندق
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
