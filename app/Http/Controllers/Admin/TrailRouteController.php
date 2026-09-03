<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrailRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrailRouteController extends Controller
{
    public function index(): View
    {
        return view('admin.routes.index', [
            'routes' => TrailRoute::ordered()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.routes.form', ['route' => new TrailRoute()]);
    }

    public function store(Request $request): RedirectResponse
    {
        TrailRoute::create($this->validated($request));

        return redirect()->route('admin.routes.index')->with('status', 'Rute baru ditambahkan.');
    }

    public function edit(TrailRoute $route): View
    {
        return view('admin.routes.form', compact('route'));
    }

    public function update(Request $request, TrailRoute $route): RedirectResponse
    {
        $route->update($this->validated($request));

        return redirect()->route('admin.routes.index')->with('status', 'Rute diperbarui.');
    }

    public function destroy(TrailRoute $route): RedirectResponse
    {
        $route->delete();

        return redirect()->route('admin.routes.index')->with('status', 'Rute dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'difficulty' => ['required', 'in:' . implode(',', TrailRoute::DIFFICULTIES)],
            'icon' => ['required', 'in:' . implode(',', TrailRoute::ICONS)],
            'distance' => ['required', 'string', 'max:50'],
            'elevation' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);
    }
}
