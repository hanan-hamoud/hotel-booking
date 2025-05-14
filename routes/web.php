<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\BookingReport;
use App\Http\Livewire\RoomSearch;
use App\Http\Livewire\BookRoom;
use App\Livewire\BookRoomForm;
use App\Http\Controllers\BookingReportController;
use App\Http\Controllers\BookingController; 

use App\Models\Room;

Route::get('/book-room/{room}', function ($roomId) {
    $room = Room::findOrFail($roomId);
    return view('book-room', ['room' => $room]);
})->name('book-room');


Route::post('/admin/booking-report/download',
 [BookingReportController::class, 'download'])
    ->name('admin.booking-report.download');

Route::get('/search', function () {
    return view('room-search-page');
});

Route::get('/', function () {
    return view('welcome');
});



