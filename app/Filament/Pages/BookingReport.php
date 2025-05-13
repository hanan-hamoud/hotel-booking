<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;

class BookingReport extends Page
{
    protected static ?string $slug = 'booking-report';
    protected static string $view = 'filament.pages.booking-report';

    protected static ?string $navigationLabel = 'تقرير الحجوزات';
    protected static ?string $navigationGroup = 'التقارير';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function renderStatic(): View
    {
        $bookings = Booking::with(['hotel', 'room'])->get();
    
        return view('filament.pages.booking-report', compact('bookings'));
    }
    
    
    

    public static function downloadPdf()
    {
        $bookings = Booking::with(['hotel', 'room'])->get();

        $pdf = Pdf::loadView('reports.booking-summary', [
            'bookings' => $bookings,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'booking-summary-report.pdf');
    }
}



