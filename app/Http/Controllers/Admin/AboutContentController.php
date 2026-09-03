<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutContentController extends Controller
{
    /** Singleton — tidak ada index/create/destroy, cuma satu form edit. */
    public function edit(): View
    {
        return view('admin.about.edit', [
            'about' => AboutContent::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'heading' => ['required', 'string', 'max:255'],
            'paragraph_1' => ['required', 'string'],
            'paragraph_2' => ['required', 'string'],
            'graphic_caption' => ['required', 'string', 'max:255'],
            'value_chips' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        // Satu baris tekstual di textarea = satu chip nilai komunitas.
        $data['value_chips'] = collect(explode("\n", $data['value_chips']))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        $about = AboutContent::current();

        if ($request->hasFile('image')) {
            if ($about->image_path) {
                Storage::disk('public')->delete($about->image_path);
            }
            $data['image_path'] = $request->file('image')->store('about', 'public');
        } elseif ($request->boolean('remove_image') && $about->image_path) {
            Storage::disk('public')->delete($about->image_path);
            $data['image_path'] = null;
        }

        $about->update($data);

        return redirect()->route('admin.about.edit')->with('status', 'Konten "Tentang Kami" diperbarui.');
    }
}
