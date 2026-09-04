@extends('admin.layout')

@section('title', 'Edit Poster Event')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Edit Poster Event</h1>
            <p>Diunggah oleh {{ $poster->contributor->name }} ({{ $poster->contributor->email }})</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.posters.update', $poster) }}" class="admin-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="admin-field">
            <label for="image">Poster</label>
            <img src="{{ $poster->image_url }}" alt="Poster saat ini" style="width:120px; aspect-ratio:3/4; object-fit:cover; border:1px solid var(--line);">
            <input type="file" id="image" name="image" accept="image/*">
            <span class="hint">Kosongkan kalau tidak ingin ganti gambar. JPG/PNG/WebP, maks 4MB.</span>
            @error('image') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="title">Judul Event</label>
            <input type="text" id="title" name="title" value="{{ old('title', $poster->title) }}" required>
            @error('title') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="category">Kategori</label>
            <select id="category" name="category" required>
                @foreach (\App\Models\EventPoster::CATEGORIES as $option)
                    <option value="{{ $option }}" @selected(old('category', $poster->category) === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('category') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="city">Kota</label>
            <input type="text" id="city" name="city" value="{{ old('city', $poster->city) }}" required>
            @error('city') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="kecamatan">Kecamatan</label>
            <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $poster->kecamatan) }}" required>
            @error('kecamatan') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="province">Provinsi</label>
            <input type="text" id="province" name="province" value="{{ old('province', $poster->province) }}" required>
            @error('province') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="event_date">Tanggal Event</label>
            <input type="date" id="event_date" name="event_date" value="{{ old('event_date', $poster->event_date->format('Y-m-d')) }}" required>
            @error('event_date') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Simpan Perubahan</button>
            <a href="{{ route('admin.posters.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
@endsection
