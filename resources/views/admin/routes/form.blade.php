@extends('admin.layout')

@section('title', $route->exists ? 'Edit Rute' : 'Tambah Rute')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>{{ $route->exists ? 'Edit Rute' : 'Tambah Rute' }}</h1>
            <p>{{ $route->exists ? $route->name : 'Isi detail jalur baru.' }}</p>
        </div>
    </div>

    <form method="POST"
          action="{{ $route->exists ? route('admin.routes.update', $route) : route('admin.routes.store') }}"
          class="admin-form" enctype="multipart/form-data">
        @csrf
        @if ($route->exists) @method('PUT') @endif

        <div class="admin-field">
            <label for="name">Nama Rute</label>
            <input type="text" id="name" name="name" value="{{ old('name', $route->name) }}" required>
            @error('name') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="difficulty">Level Kesulitan</label>
            <select id="difficulty" name="difficulty" required>
                @foreach (\App\Models\TrailRoute::DIFFICULTIES as $option)
                    <option value="{{ $option }}" @selected(old('difficulty', $route->difficulty) === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </div>

        <div class="admin-field">
            <label for="icon">Ikon</label>
            <select id="icon" name="icon" required>
                @foreach (\App\Models\TrailRoute::ICONS as $option)
                    <option value="{{ $option }}" @selected(old('icon', $route->icon) === $option)>{{ ucfirst($option) }}</option>
                @endforeach
            </select>
            <span class="hint">Ikon garis yang tampil di kartu rute.</span>
        </div>

        <div class="admin-field">
            <label for="distance">Jarak</label>
            <input type="text" id="distance" name="distance" value="{{ old('distance', $route->distance) }}" placeholder="mis. 20 KM" required>
        </div>

        <div class="admin-field">
            <label for="elevation">Elevasi / Info Tambahan</label>
            <input type="text" id="elevation" name="elevation" value="{{ old('elevation', $route->elevation) }}" placeholder="mis. 2.100 MDPL" required>
        </div>

        <div class="admin-field">
            <label for="description">Deskripsi Trek</label>
            <textarea id="description" name="description" required>{{ old('description', $route->description) }}</textarea>
            <span class="hint">Ditampilkan di kartu rute dan di halaman detail waktu rute ini diklik.</span>
        </div>

        <div class="admin-field">
            <label for="map_image">Gambar Peta Jalur</label>
            @if ($route->map_image_url)
                <img src="{{ $route->map_image_url }}" alt="Peta saat ini" style="width:200px; aspect-ratio:4/3; object-fit:cover; border:1px solid var(--line);">
                <label style="display:flex; align-items:center; gap:0.5rem; font-family:var(--font-body); text-transform:none; letter-spacing:0; color:var(--ink-soft); font-size:0.88rem;">
                    <input type="checkbox" name="remove_map_image" value="1" style="width:auto;"> Hapus gambar peta ini
                </label>
            @endif
            <input type="file" id="map_image" name="map_image" accept="image/*">
            <span class="hint">JPG/PNG/WebP, maks 4MB. Tampil di halaman detail rute.</span>
            @error('map_image') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        @php
            $teaserSource = old('teaser_video_source', $route->teaser_youtube_url ? 'youtube' : ($route->teaser_video_path ? 'upload' : 'upload'));
        @endphp
        <div class="admin-field">
            <label>Video Teaser Jalur</label>
            <div style="display:flex; gap:1.2rem; margin-bottom:0.4rem;">
                <label style="display:flex; align-items:center; gap:0.4rem; font-family:var(--font-body); text-transform:none; letter-spacing:0; color:var(--ink-soft); font-size:0.9rem;">
                    <input type="radio" name="teaser_video_source" value="upload" class="js-teaser-source" style="width:auto;" @checked($teaserSource === 'upload')> Upload File
                </label>
                <label style="display:flex; align-items:center; gap:0.4rem; font-family:var(--font-body); text-transform:none; letter-spacing:0; color:var(--ink-soft); font-size:0.9rem;">
                    <input type="radio" name="teaser_video_source" value="youtube" class="js-teaser-source" style="width:auto;" @checked($teaserSource === 'youtube')> Link YouTube
                </label>
                <label style="display:flex; align-items:center; gap:0.4rem; font-family:var(--font-body); text-transform:none; letter-spacing:0; color:var(--ink-soft); font-size:0.9rem;">
                    <input type="radio" name="teaser_video_source" value="none" class="js-teaser-source" style="width:auto;" @checked($teaserSource === 'none')> Tidak ada
                </label>
            </div>

            <div class="js-teaser-panel" data-source="upload" style="{{ $teaserSource === 'upload' ? '' : 'display:none;' }}">
                @if ($route->teaser_video_url)
                    <video src="{{ $route->teaser_video_url }}" controls style="width:280px; aspect-ratio:16/9; border:1px solid var(--line); margin-bottom:0.6rem;"></video>
                @endif
                <input type="file" id="teaser_video" name="teaser_video" accept="video/mp4,video/webm,video/quicktime">
                <span class="hint">MP4/WebM/MOV, maks 40MB. {{ $route->teaser_video_url ? 'Kosongkan untuk tetap pakai video yang sekarang.' : '' }}</span>
                @error('teaser_video') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="js-teaser-panel" data-source="youtube" style="{{ $teaserSource === 'youtube' ? '' : 'display:none;' }}">
                <input type="url" id="teaser_youtube_url" name="teaser_youtube_url" value="{{ old('teaser_youtube_url', $route->teaser_youtube_url) }}" placeholder="https://www.youtube.com/watch?v=...">
                <span class="hint">Tempel link video YouTube — bisa format watch, youtu.be, atau shorts.</span>
                @error('teaser_youtube_url') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <p class="hint">Tampil di halaman detail rute. Ganti sumber otomatis menghapus video dari sumber sebelumnya.</p>
        </div>

        <script>
            document.querySelectorAll('.js-teaser-source').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    document.querySelectorAll('.js-teaser-panel').forEach(function (panel) {
                        panel.style.display = panel.dataset.source === radio.value ? '' : 'none';
                    });
                });
            });
        </script>

        <div class="admin-field">
            <label for="sort_order">Urutan Tampil</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $route->sort_order ?? 0) }}">
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Simpan</button>
            <a href="{{ route('admin.routes.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>

    @if ($route->exists)
        <div class="admin-topbar" style="margin-top:2.5rem;">
            <div>
                <h1 style="font-size:1.5rem;">Galeri Foto</h1>
                <p>Foto tambahan yang tampil di halaman detail rute ini.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.routes.photos.store', $route) }}" class="admin-form" enctype="multipart/form-data" style="margin-bottom:1.5rem;">
            @csrf
            <div class="admin-field">
                <label for="photos">Tambah Foto</label>
                <input type="file" id="photos" name="photos[]" accept="image/*" multiple required>
                <span class="hint">Bisa pilih beberapa foto sekaligus. JPG/PNG/WebP, maks 4MB per foto.</span>
                @error('photos') <span class="field-error">{{ $message }}</span> @enderror
                @error('photos.*') <span class="field-error">{{ $message }}</span> @enderror
            </div>
            <div class="admin-form-actions">
                <button type="submit" class="btn btn-outline btn-sm" style="cursor:pointer;">Unggah Foto</button>
            </div>
        </form>

        @if ($route->photos->isEmpty())
            <p style="color:var(--ink-faint); font-size:0.9rem;">Belum ada foto galeri.</p>
        @else
            <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(120px,1fr)); gap:0.8rem;">
                @foreach ($route->photos as $photo)
                    <div style="position:relative;">
                        <img src="{{ $photo->image_url }}" alt="" style="width:100%; aspect-ratio:1; object-fit:cover; border:1px solid var(--line);">
                        <form method="POST" action="{{ route('admin.routes.photos.destroy', [$route, $photo]) }}" onsubmit="return confirm('Hapus foto ini?');" style="position:absolute; top:0.4rem; right:0.4rem;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="cursor:pointer; padding:0.3rem 0.5rem;">✕</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
@endsection
