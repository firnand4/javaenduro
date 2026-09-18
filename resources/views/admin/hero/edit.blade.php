@extends('admin.layout')

@section('title', 'Video Beranda')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Video Beranda</h1>
            <p>Video latar loop di section Beranda (hero) landing page.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.hero.update') }}" class="admin-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="admin-field">
            <label for="video">Video Latar</label>
            @if ($hero->video_url)
                <video src="{{ $hero->video_url }}" style="width:280px; aspect-ratio:16/9; object-fit:cover; border:1px solid var(--line);" muted loop autoplay playsinline></video>
                <label style="display:flex; align-items:center; gap:0.5rem; font-family:var(--font-body); text-transform:none; letter-spacing:0; color:var(--ink-soft); font-size:0.88rem;">
                    <input type="checkbox" name="remove_video" value="1" style="width:auto;"> Hapus video ini (kembali ke latar polos)
                </label>
            @endif
            <input type="file" id="video" name="video" accept="video/mp4,video/webm,video/quicktime">
            <span class="hint">MP4/WebM/MOV, maks 40MB. Video pendek (5–15 detik) yang di-loop hasilnya paling halus. Kosongkan kalau belum ada video, section Beranda tetap pakai latar polos seperti sekarang.</span>
            @error('video') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
@endsection
