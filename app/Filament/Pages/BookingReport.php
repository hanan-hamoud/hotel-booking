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


    
    public function mount(): void
    {
        $this->bookings = Booking::with('room.hotel')->get();
    }
   
    
    

    

}



