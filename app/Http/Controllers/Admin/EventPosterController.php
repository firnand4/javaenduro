<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventPoster;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventPosterController extends Controller
{
    public function index(Request $request): View
    {
        $showArchived = $request->boolean('arsip');

        $query = EventPoster::with('contributor')->latest();

        $posters = $showArchived
            ? $query->where('status', 'archived')->get()
            : $query->notArchived()->orderByRaw("status = 'pending' desc")->get();

        return view('admin.posters.index', [
            'posters' => $posters,
            'showArchived' => $showArchived,
            'archivedCount' => EventPoster::where('status', 'archived')->count(),
        ]);
    }

    public function updateStatus(Request $request, EventPoster $poster): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:' . implode(',', EventPoster::STATUSES)],
        ]);

        $poster->update($data);

        return back()->with('status', "Status poster \"{$poster->city}, {$poster->province}\" diubah jadi " . ucfirst($data['status']) . '.');
    }

    public function edit(EventPoster $poster): View
    {
        return view('admin.posters.edit', compact('poster'));
    }

    public function update(Request $request, EventPoster $poster): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:' . implode(',', EventPoster::CATEGORIES)],
            'city' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            if ($poster->image_path) {
                Storage::disk('public')->delete($poster->image_path);
            }
            $data['image_path'] = $request->file('image')->store('posters', 'public');
        }

        $poster->update($data);

        return redirect()->route('admin.posters.index')->with('status', "Poster \"{$data['title']}\" diperbarui.");
    }

    public function destroy(EventPoster $poster): RedirectResponse
    {
        $location = "{$poster->city}, {$poster->province}";

        if ($poster->image_path) {
            Storage::disk('public')->delete($poster->image_path);
        }
        $poster->delete();

        return back()->with('status', "Poster \"{$location}\" dihapus permanen.");
    }
}
