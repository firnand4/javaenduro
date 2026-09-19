@extends('admin.layout')

@section('title', 'Logo Situs')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Logo Situs</h1>
            <p>Logo yang tampil di navbar, footer, halaman admin, dan halaman kontributor.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.branding.update') }}" class="admin-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="admin-field">
            <label for="logo">Logo</label>
            @if ($site->logo_url)
                <div style="padding:1rem; background:var(--bg); border:1px solid var(--line); display:inline-block;">
                    <img src="{{ $site->logo_url }}" alt="Logo saat ini" style="height:48px; width:auto; display:block;">
                </div>
                <label style="display:flex; align-items:center; gap:0.5rem; font-family:var(--font-body); text-transform:none; letter-spacing:0; color:var(--ink-soft); font-size:0.88rem;">
                    <input type="checkbox" name="remove_logo" value="1" style="width:auto;"> Hapus logo ini (kembali ke logo teks bawaan)
                </label>
            @endif
            <input type="file" id="logo" name="logo" accept="image/png,image/jpeg,image/webp">
            <span class="hint">PNG/JPG/WebP, maks 2MB. Sebaiknya PNG transparan, latar situs gelap. Kosongkan kalau belum ada logo, situs tetap pakai logo teks "JE · JAVAENDURO" bawaan.</span>
            @error('logo') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
@endsection
