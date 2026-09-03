<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\ScheduleEvent;
use App\Models\TrailRoute;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'routeCount' => TrailRoute::count(),
            'eventCount' => ScheduleEvent::count(),
            'galleryCount' => GalleryItem::count(),
            'nextEvent' => ScheduleEvent::upcomingFirst()->where('event_date', '>=', now())->first(),
        ]);
    }
}
