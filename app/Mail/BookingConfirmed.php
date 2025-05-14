<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public Booking $booking;

  
    public function __construct(Booking $booking)
    {
        $this->booking = $booking->load('room'); 
    }
    public function build()
    {
        return $this->subject('Booking Confirmation')
                    ->view('emails.booking-confirmed') 
                    ->with(['booking' => $this->booking]);
    }
}
