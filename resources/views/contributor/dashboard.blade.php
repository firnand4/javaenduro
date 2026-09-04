@extends('contributor.layout')

@section('title', 'Dashboard Kontributor')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Halo, {{ auth()->user()->name }}</h1>
            <p>Unggah poster event trabas kamu — akan tayang di landing page setelah divalidasi superadmin.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('contributor.poster.store') }}" class="admin-form" enctype="multipart/form-data" style="margin-bottom:2.5rem;">
        @csrf

        <div class="admin-field">
            <label for="image">Poster Event</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <span class="hint">JPG/PNG/WebP, maks 4MB.</span>
            @error('image') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="title">Judul Event</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="mis. Baksos Trail Jelajah Pesisir 3" required>
            @error('title') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="category">Kategori</label>
            <select id="category" name="category" required>
                @foreach (\App\Models\EventPoster::CATEGORIES as $option)
                    <option value="{{ $option }}" @selected(old('category') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('category') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="city">Kota</label>
            <input type="text" id="city" name="city" value="{{ old('city') }}" required>
            @error('city') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="kecamatan">Kecamatan</label>
            <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" required>
            @error('kecamatan') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="province">Provinsi</label>
            <input type="text" id="province" name="province" value="{{ old('province') }}" required>
            @error('province') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="event_date">Tanggal Event</label>
            <input type="date" id="event_date" name="event_date" value="{{ old('event_date') }}" required>
            @error('event_date') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Unggah Poster</button>
        </div>
    </form>

    <h2 style="font-family:var(--font-display); text-transform:uppercase; font-size:1.5rem; margin-bottom:1rem;">Poster Saya</h2>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Poster</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Tanggal Event</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posters as $poster)
                    <tr>
                        <td><img src="{{ $poster->image_url }}" alt="" style="width:44px; height:56px; object-fit:cover; border:1px solid var(--line);"></td>
                        <td>{{ $poster->display_title }}</td>
                        <td>{{ $poster->category }}</td>
                        <td>{{ $poster->location_label }}</td>
                        <td class="tabular">{{ $poster->date_label }}</td>
                        <td>
                            <div class="row-actions" style="align-items:center;">
                                <span class="status-badge {{ $poster->status }}">{{ ucfirst($poster->status) }}</span>
                                @if ($poster->status !== 'approved')
                                    <form method="POST" action="{{ route('contributor.poster.destroy', $poster) }}" onsubmit="return confirm('Hapus poster ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="cursor:pointer;">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="wrap-cell">Belum ada poster yang kamu unggah.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
