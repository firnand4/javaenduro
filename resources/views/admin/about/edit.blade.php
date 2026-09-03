@extends('admin.layout')

@section('title', 'Tentang Kami')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Tentang Kami</h1>
            <p>Isi section "Tentang Kami" di landing page.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.about.update') }}" class="admin-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="admin-field">
            <label for="heading">Judul</label>
            <input type="text" id="heading" name="heading" value="{{ old('heading', $about->heading) }}" required>
            @error('heading') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="image">Foto di Samping Tentang Kami</label>
            @if ($about->image_url)
                <img src="{{ $about->image_url }}" alt="Foto saat ini" style="width:160px; aspect-ratio:4/5; object-fit:cover; border:1px solid var(--line);">
                <label style="display:flex; align-items:center; gap:0.5rem; font-family:var(--font-body); text-transform:none; letter-spacing:0; color:var(--ink-soft); font-size:0.88rem;">
                    <input type="checkbox" name="remove_image" value="1" style="width:auto;"> Hapus foto ini (kembali ke ilustrasi kontur bawaan)
                </label>
            @endif
            <input type="file" id="image" name="image" accept="image/*">
            <span class="hint">JPG/PNG/WebP, maks 4MB. Kalau belum ada foto, section ini memakai ilustrasi kontur gunung bawaan.</span>
            @error('image') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="paragraph_1">Paragraf 1</label>
            <textarea id="paragraph_1" name="paragraph_1" required>{{ old('paragraph_1', $about->paragraph_1) }}</textarea>
            @error('paragraph_1') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="paragraph_2">Paragraf 2</label>
            <textarea id="paragraph_2" name="paragraph_2" required>{{ old('paragraph_2', $about->paragraph_2) }}</textarea>
            @error('paragraph_2') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="value_chips">Nilai Komunitas</label>
            <textarea id="value_chips" name="value_chips" rows="4" required>{{ old('value_chips', implode("\n", $about->value_chips)) }}</textarea>
            <span class="hint">Satu nilai per baris — tampil sebagai chip kecil di bawah paragraf.</span>
            @error('value_chips') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="graphic_caption">Label Ilustrasi</label>
            <input type="text" id="graphic_caption" name="graphic_caption" value="{{ old('graphic_caption', $about->graphic_caption) }}" required>
            <span class="hint">Teks kecil di pojok bawah ilustrasi kontur gunung, mis. daftar nama gunung.</span>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
@endsection
