<?php

namespace Wepa\BroadcastSchedule\Http\Controllers\Backend;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Inertia\Response;
use Wepa\BroadcastSchedule\Http\Requests\Backend\CalendarRequest;
use Wepa\BroadcastSchedule\Http\Resources\CalendarResource;
use Wepa\BroadcastSchedule\Models\Calendar;
use Wepa\BroadcastSchedule\Models\Program;
use Wepa\Core\Http\Controllers\Backend\InertiaController;

class CalendarController extends InertiaController
{
    public string $packageName = 'broadcast-schedule';

    public function destroy(Calendar $calendar): RedirectResponse
    {
        $calendar->delete();

        return redirect()->back();
    }

    public function edit(Calendar $calendar): Response
    {
        $programs = Program::all();

        return $this->render('Vendor/BroadcastSchedule/Backend/Calendar/Edit', ['backend/calendars'],
            compact(['calendar', 'programs']));
    }

    public function index(Request $request): Response
    {
        if (! $day = request('day')) {
            $day = strtolower(date('l'));
        }

        $calendars = CalendarResource::collection(Calendar::when($request->search, function ($query, $search) {
            $query->whereHas('program', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%');
            });
        })->orderBy('time')->get());

        return $this->render('Vendor/BroadcastSchedule/Backend/Calendar/Index', ['backend/calendars'],
            compact(['calendars', 'day']));
    }

    public function show(Calendar $calendar): Response
    {
        return $this->render('Vendor/BroadcastSchedule/Backend/Calendar/Show', ['backend/calendars'],
            compact(['calendar']));
    }

    public function store(CalendarRequest $request): Application|RedirectResponse|Redirector
    {
        Calendar::create($request->all());

        return redirect()->route('admin.broadcast-schedule.calendars.index', ['day' => $request->day]);
    }

    public function create(): Response
    {
        $programs = Program::all();
        if (! $day = request('day')) {
            $day = strtolower(date('l'));
        }

        return $this->render('Vendor/BroadcastSchedule/Backend/Calendar/Create', ['backend/calendars'],
            compact(['programs', 'day']));
    }

    public function update(CalendarRequest $request, Calendar $calendar): Redirector|RedirectResponse|Application
    {
        $calendar->update($request->all());

        return redirect()->route('admin.broadcast-schedule.calendars.index', ['day' => $request->day]);
    }
}
