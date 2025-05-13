<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;
use PDF; 
use Carbon\Carbon;
class BookingReportController extends Controller
{
    public function download(Request $request)
    {
        $bookings = Booking::with('room.hotel')->get();

        $pdf = PDF::loadView('reports.bookings-pdf', compact('bookings'));

        return $pdf->download('booking_report_' . Carbon::now()->format('Y_m_d_His') . '.pdf');
    }
}
