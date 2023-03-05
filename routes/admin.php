<?php

use Illuminate\Support\Facades\Route;
use Wepa\BroadcastSchedule\Http\Controllers\Backend\CalendarController;
use Wepa\BroadcastSchedule\Http\Controllers\Backend\ProgramController;

Route::prefix('admin/broadcast-schedule')->middleware(['web', 'auth:sanctum'])->group(function () {
    Route::resource('calendars', CalendarController::class)->names('admin.broadcast-schedule.calendars');
    Route::resource('programs', ProgramController::class)->names('admin.broadcast-schedule.programs');
});
