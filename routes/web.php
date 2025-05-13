<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\BookingReport;
use App\Http\Livewire\RoomSearch;
use App\Http\Livewire\BookRoom;

Route::get('/search', function () {
    return view('room-search-page');
});

Route::get('/book-room/{room}', function ($room) {
    return view('book-room-page', ['roomId' => $room]);
})->name('book-room');


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/booking-report', [BookingReport::class, 'render'])
//     ->name('filament.admin.pages.booking-report');

    Route::post('/admin/booking-report/download', [BookingReportController::class, 'download'])
    ->name('admin.booking-report.download');
