<?php

namespace Wepa\BroadcastSchedule\Http\Controllers\Backend;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Inertia\Response;
use Wepa\BroadcastSchedule\Http\Requests\Backend\ProgramRequest;
use Wepa\BroadcastSchedule\Models\Program;
use Wepa\Core\Http\Controllers\Backend\InertiaController;

class ProgramController extends InertiaController
{
    public string $packageName = 'broadcast-schedule';

    public function index(): Response
    {
        $programs = Program::all();

        return $this->render('Vendor/BroadcastSchedule/Backend/Program/Index', ['backend/programs'],
            compact(['programs']));
    }

    public function show(Program $program): Response
    {
        return $this->render('Vendor/BroadcastSchedule/Backend/Program/Show', ['BroadcastSchedule'],
            compact(['program']));
    }

    public function edit(Program $program): Response
    {
        return $this->render('Vendor/BroadcastSchedule/Backend/Program/Edit', ['backend/programs'],
            compact(['program']));
    }

    public function update(ProgramRequest $request, Program $program): Redirector|RedirectResponse|Application
    {
        $program->update($request->all());

        return redirect()->route('admin.broadcast-schedule.programs.index');
    }

    public function store(ProgramRequest $request): Redirector|RedirectResponse|Application
    {
        Program::create($request->all());

        return redirect()->route('admin.broadcast-schedule.programs.index');
    }

    public function create(): Response
    {
        return $this->render('Vendor/BroadcastSchedule/Backend/Program/Create', ['backend/programs']);
    }

    public function destroy(Request $request, Program $program): RedirectResponse
    {
        $program->delete();

        return redirect()->back();
    }
}
