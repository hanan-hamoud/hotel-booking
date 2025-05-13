<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\BookingReport;
use App\Http\Livewire\RoomSearch;
use App\Http\Livewire\BookRoom;


use App\Http\Controllers\BookingReportController;


Route::post('/admin/booking-report/download',
 [BookingReportController::class, 'download'])
    ->name('admin.booking-report.download');

Route::get('/search', function () {
    return view('room-search-page');
});

Route::get('/book-room/{room}', function ($room) {
    return view('book-room-page', ['roomId' => $room]);
})->name('book-room');


Route::get('/', function () {
    return view('welcome');
});

