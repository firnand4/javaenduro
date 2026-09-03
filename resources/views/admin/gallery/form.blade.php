@extends('admin.layout')

@section('title', $item->exists ? 'Edit Ubin Galeri' : 'Tambah Ubin Galeri')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>{{ $item->exists ? 'Edit Ubin Galeri' : 'Tambah Ubin Galeri' }}</h1>
            <p>{{ $item->exists ? $item->caption : 'Isi detail ubin baru.' }}</p>
        </div>
    </div>

    <form method="POST"
          action="{{ $item->exists ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}"
          class="admin-form" enctype="multipart/form-data">
        @csrf
        @if ($item->exists) @method('PUT') @endif

        <div class="admin-field">
            <label for="caption">Caption</label>
            <input type="text" id="caption" name="caption" value="{{ old('caption', $item->caption) }}" required>
            @error('caption') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="image">Foto</label>
            @if ($item->image_url)
                <img src="{{ $item->image_url }}" alt="Foto saat ini" style="width:160px; aspect-ratio:1; object-fit:cover; border:1px solid var(--line);">
                <span class="hint">Unggah file baru untuk mengganti foto ini.</span>
            @endif
            <input type="file" id="image" name="image" accept="image/*" {{ $item->exists ? '' : 'required' }}>
            <span class="hint">JPG/PNG/WebP, maks 4MB.</span>
            @error('image') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="sort_order">Urutan Tampil</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Simpan</button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
@endsection
