<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookRoom(Room $room)
    {
        return view('book-room', compact('room'));
    }
}

