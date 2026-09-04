<?php

namespace App\Http\Controllers\Contributor;

use App\Http\Controllers\Controller;
use App\Models\EventPoster;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventPosterController extends Controller
{
    public function index(): View
    {
        return view('contributor.dashboard', [
            'posters' => EventPoster::where('user_id', auth()->id())->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:' . implode(',', EventPoster::CATEGORIES)],
            'city' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'image' => ['required', 'image', 'max:4096'],
        ]);

        $data['image_path'] = $request->file('image')->store('posters', 'public');
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        EventPoster::create($data);

        return redirect()->route('contributor.dashboard')->with('status', 'Poster diunggah — menunggu validasi superadmin sebelum tampil di landing page.');
    }

    public function destroy(EventPoster $poster): RedirectResponse
    {
        abort_unless($poster->user_id === auth()->id(), 403);

        if ($poster->status === 'approved') {
            return back()->with('status', 'Poster yang sudah divalidasi tidak bisa dihapus sendiri — hubungi superadmin.');
        }

        Storage::disk('public')->delete($poster->image_path);
        $poster->delete();

        return back()->with('status', 'Poster dihapus.');
    }
}
