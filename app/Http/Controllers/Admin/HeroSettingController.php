<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeroSettingController extends Controller
{
    /** Singleton — tidak ada index/create/destroy, cuma satu form edit. */
    public function edit(): View
    {
        return view('admin.hero.edit', [
            'hero' => HeroSetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'video' => ['nullable', 'file', 'mimes:mp4,webm,mov', 'max:40960'],
        ]);

        $hero = HeroSetting::current();

        if ($request->hasFile('video')) {
            if ($hero->video_path) {
                Storage::disk('public')->delete($hero->video_path);
            }
            $data['video_path'] = $request->file('video')->store('hero', 'public');
        } elseif ($request->boolean('remove_video') && $hero->video_path) {
            Storage::disk('public')->delete($hero->video_path);
            $data['video_path'] = null;
        }

        $hero->update($data);

        return redirect()->route('admin.hero.edit')->with('status', 'Video latar Beranda diperbarui.');
    }
}
