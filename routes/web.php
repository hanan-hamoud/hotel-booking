<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\BookingReport;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/booking-report', [BookingReport::class, 'render'])
    ->name('filament.admin.pages.booking-report');

    Route::post('/admin/booking-report/download', [BookingReportController::class, 'download'])
    ->name('admin.booking-report.download');
