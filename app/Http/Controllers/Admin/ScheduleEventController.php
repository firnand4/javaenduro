<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScheduleEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleEventController extends Controller
{
    public function index(): View
    {
        return view('admin.schedule.index', [
            'events' => ScheduleEvent::upcomingFirst()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.schedule.form', ['event' => new ScheduleEvent()]);
    }

    public function store(Request $request): RedirectResponse
    {
        ScheduleEvent::create($this->validated($request));

        return redirect()->route('admin.schedule.index')->with('status', 'Event baru ditambahkan.');
    }

    public function edit(ScheduleEvent $schedule): View
    {
        return view('admin.schedule.form', ['event' => $schedule]);
    }

    public function update(Request $request, ScheduleEvent $schedule): RedirectResponse
    {
        $schedule->update($this->validated($request));

        return redirect()->route('admin.schedule.index')->with('status', 'Event diperbarui.');
    }

    public function destroy(ScheduleEvent $schedule): RedirectResponse
    {
        $schedule->delete();

        return redirect()->route('admin.schedule.index')->with('status', 'Event dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'event_date' => ['required', 'date'],
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:' . implode(',', ScheduleEvent::TYPES)],
        ]);
    }
}
