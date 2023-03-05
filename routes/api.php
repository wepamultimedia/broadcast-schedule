<?php

use Illuminate\Support\Facades\Route;
use Wepa\BroadcastSchedule\Http\Controllers\Api\CalendarController;

Route::prefix('api/v1/broadcast-schedule')->middleware(['web', 'api'])->group(function () {
    Route::get('calendars/day/{day?}', [CalendarController::class, 'getDay'])->name('api.v1.broadcast-schedule.calendar.day');
});
