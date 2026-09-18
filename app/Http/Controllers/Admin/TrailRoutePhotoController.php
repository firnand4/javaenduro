<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrailRoute;
use App\Models\TrailRoutePhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrailRoutePhotoController extends Controller
{
    public function store(Request $request, TrailRoute $route): RedirectResponse
    {
        $request->validate([
            'photos' => ['required', 'array', 'min:1'],
            'photos.*' => ['image', 'max:4096'],
        ]);

        $nextOrder = (int) $route->photos()->max('sort_order');

        foreach ($request->file('photos') as $file) {
            $nextOrder++;
            TrailRoutePhoto::create([
                'trail_route_id' => $route->id,
                'image_path' => $file->store('routes/gallery', 'public'),
                'sort_order' => $nextOrder,
            ]);
        }

        return back()->with('status', 'Foto galeri ditambahkan.');
    }

    public function destroy(TrailRoute $route, TrailRoutePhoto $photo): RedirectResponse
    {
        abort_unless($photo->trail_route_id === $route->id, 404);

        Storage::disk('public')->delete($photo->image_path);
        $photo->delete();

        return back()->with('status', 'Foto galeri dihapus.');
    }
}
