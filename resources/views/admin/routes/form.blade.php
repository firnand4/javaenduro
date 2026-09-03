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
          class="admin-form">
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
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" required>{{ old('description', $route->description) }}</textarea>
        </div>

        <div class="admin-field">
            <label for="sort_order">Urutan Tampil</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $route->sort_order ?? 0) }}">
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Simpan</button>
            <a href="{{ route('admin.routes.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
@endsection
