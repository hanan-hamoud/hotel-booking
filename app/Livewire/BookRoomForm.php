<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
use App\Models\Booking; 
use App\Enums\RoomStatus;
class BookRoomForm extends Component
{
    public $room; 
    public $guest_name, $guest_email, $guest_phone, $check_in_date, $check_out_date, $special_request;

    public function mount(Room $room)
    {
        $this->room = $room;
    }

    public function bookRoom()
    {
        $this->validate([
            'guest_name' => 'required',
            'guest_email' => 'required|email',
            'guest_phone' => 'required',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);
    
        $existingBooking = Booking::where('room_id', $this->room->id)
            ->where(function ($query) {
                $query->whereBetween('check_in_date', [$this->check_in_date, $this->check_out_date])
                      ->orWhereBetween('check_out_date', [$this->check_in_date, $this->check_out_date])
                      ->orWhere(function($q) {
                          $q->where('check_in_date', '<=', $this->check_in_date)
                            ->where('check_out_date', '>=', $this->check_out_date);
                      });
            })
            ->exists();
    
        if ($existingBooking) {
            session()->flash('error', 'This room is already booked for the selected dates.');
            return;
        }
    
        $booking = new Booking();
        $booking->room_id = $this->room->id;
        $booking->guest_name = $this->guest_name;
        $booking->guest_email = $this->guest_email;
        $booking->guest_phone = $this->guest_phone;
        $booking->check_in_date = $this->check_in_date;
        $booking->check_out_date = $this->check_out_date;
        $booking->special_request = $this->special_request;
        $booking->status = RoomStatus::Booked->value;
        $booking->save();
    
        \Mail::to($this->guest_email)->send(new \App\Mail\BookingConfirmed($booking));
    
        session()->flash('success', 'Your booking has been confirmed and a confirmation email has been sent.');
        
        $this->reset(['guest_name', 'guest_email', 'guest_phone', 'check_in_date', 'check_out_date', 'special_request']);
    }
    

    public function render()
    {
        return view('livewire.book-room-form');
    }
}
