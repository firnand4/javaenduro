<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryItemController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index', [
            'items' => GalleryItem::ordered()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.gallery.form', ['item' => new GalleryItem()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'caption' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['required', 'image', 'max:4096'],
        ]);

        $data['image_path'] = $request->file('image')->store('gallery', 'public');

        GalleryItem::create($data);

        return redirect()->route('admin.gallery.index')->with('status', 'Ubin galeri baru ditambahkan.');
    }

    public function edit(GalleryItem $gallery): View
    {
        return view('admin.gallery.form', ['item' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $data = $request->validate([
            'caption' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('status', 'Ubin galeri diperbarui.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('status', 'Ubin galeri dihapus.');
    }
}
