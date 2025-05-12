<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'location',
        'description',
        'number_of_rooms',
        'contact_info',
    ];

    protected $casts = [
        'contact_info' => 'array',
    ];
    

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
