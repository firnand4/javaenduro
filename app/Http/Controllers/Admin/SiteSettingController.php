<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    /** Singleton — tidak ada index/create/destroy, cuma satu form edit. */
    public function edit(): View
    {
        return view('admin.branding.edit', [
            'site' => SiteSetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ]);

        $site = SiteSetting::current();

        if ($request->hasFile('logo')) {
            if ($site->logo_path) {
                Storage::disk('public')->delete($site->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('branding', 'public');
        } elseif ($request->boolean('remove_logo') && $site->logo_path) {
            Storage::disk('public')->delete($site->logo_path);
            $data['logo_path'] = null;
        }

        $site->update($data);

        return redirect()->route('admin.branding.edit')->with('status', 'Logo situs diperbarui.');
    }
}
