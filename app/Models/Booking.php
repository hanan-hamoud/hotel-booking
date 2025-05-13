<?php

namespace App\Models;

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
        'status' => Status::class, // تأكد من أن Enum موجود ومسماه صحيح
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // ✅ طريقة آمنة للوصول إلى الفندق من خلال الغرفة
    public function hotel()
    {
        return optional($this->room)->hotel;
    }

    // ✅ أو بدلاً من ذلك كـ Accessor
    /*
    public function getHotelAttribute()
    {
        return optional($this->room)->hotel;
    }
    */
}
