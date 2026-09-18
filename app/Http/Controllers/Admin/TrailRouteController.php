<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrailRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $data = $this->validated($request);
        $data = $this->handleMediaUploads($request, $data);

        TrailRoute::create($data);

        return redirect()->route('admin.routes.index')->with('status', 'Rute baru ditambahkan.');
    }

    public function edit(TrailRoute $route): View
    {
        $route->load('photos');

        return view('admin.routes.form', compact('route'));
    }

    public function update(Request $request, TrailRoute $route): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->handleMediaUploads($request, $data, $route);

        $route->update($data);

        return redirect()->route('admin.routes.index')->with('status', 'Rute diperbarui.');
    }

    public function destroy(TrailRoute $route): RedirectResponse
    {
        if ($route->map_image_path) {
            Storage::disk('public')->delete($route->map_image_path);
        }
        if ($route->teaser_video_path) {
            Storage::disk('public')->delete($route->teaser_video_path);
        }
        foreach ($route->photos as $photo) {
            Storage::disk('public')->delete($photo->image_path);
        }

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
            'map_image' => ['nullable', 'image', 'max:4096'],
            'remove_map_image' => ['nullable', 'boolean'],
            'teaser_video_source' => ['nullable', 'in:upload,youtube,none'],
            'teaser_video' => ['nullable', 'file', 'mimes:mp4,webm,mov', 'max:40960'],
            'teaser_youtube_url' => [
                'nullable', 'string', 'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->input('teaser_video_source') !== 'youtube' || ! $value) {
                        return;
                    }
                    if (! preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))[a-zA-Z0-9_-]{11}/', $value)) {
                        $fail('Link YouTube tidak valid.');
                    }
                },
            ],
        ]);
    }

    /** Tangani upload/ganti/hapus gambar peta & video teaser — dipakai bareng store() & update(). */
    private function handleMediaUploads(Request $request, array $data, ?TrailRoute $route = null): array
    {
        unset($data['remove_map_image'], $data['teaser_video_source']);

        if ($request->hasFile('map_image')) {
            if ($route?->map_image_path) {
                Storage::disk('public')->delete($route->map_image_path);
            }
            $data['map_image_path'] = $request->file('map_image')->store('routes/maps', 'public');
        } elseif ($request->boolean('remove_map_image') && $route?->map_image_path) {
            Storage::disk('public')->delete($route->map_image_path);
            $data['map_image_path'] = null;
        }

        // Video teaser cuma boleh satu sumber aktif — ganti sumber otomatis membersihkan yang lama.
        $source = $request->input('teaser_video_source', 'none');

        if ($source === 'upload') {
            if ($request->hasFile('teaser_video')) {
                if ($route?->teaser_video_path) {
                    Storage::disk('public')->delete($route->teaser_video_path);
                }
                $data['teaser_video_path'] = $request->file('teaser_video')->store('routes/teasers', 'public');
            }
            $data['teaser_youtube_url'] = null;
        } elseif ($source === 'youtube') {
            if ($route?->teaser_video_path) {
                Storage::disk('public')->delete($route->teaser_video_path);
            }
            $data['teaser_video_path'] = null;
            $data['teaser_youtube_url'] = $request->input('teaser_youtube_url');
        } else {
            if ($route?->teaser_video_path) {
                Storage::disk('public')->delete($route->teaser_video_path);
            }
            $data['teaser_video_path'] = null;
            $data['teaser_youtube_url'] = null;
        }

        unset($data['teaser_video']);

        return $data;
    }
}
