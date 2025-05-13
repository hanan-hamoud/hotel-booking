<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;

class BookingReport extends Page
{ 

    public $bookings ;
    protected static ?string $slug = 'booking-report';
    protected static string $view = 'filament.pages.booking-report';

    protected static ?string $navigationLabel = 'تقرير الحجوزات';
    protected static ?string $navigationGroup = 'التقارير';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';


    // public function mount(): void
    // {
    //     $this->bookings = Booking::with(['hotel', 'room'])->get();
    //     Booking::with(['room.hotel'])->get(); 
    // }
    
    public function mount(): void
    {
        // تحميل الحجوزات مع الغرفة والفندق المرتبط بها
        $this->bookings = Booking::with('room.hotel')->get();
    }
    
    // public static function render(): View
    // {
    //     $bookings = Booking::with(['hotel', 'room'])->get();
    
    //     dd($bookings,'hhh');
    //     return view('filament.pages.booking-report', compact('bookings'));
    // }
    
    

    

    public static function downloadPdf()
    {
        $bookings = Booking::with(['hotel', 'room'])->get();


        dd($bookings);
        $pdf = Pdf::loadView('reports.booking-summary', [
            'bookings' => $bookings,
        ]);



        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'booking-summary-report.pdf');
    }
}



