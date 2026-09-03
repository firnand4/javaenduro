@extends('admin.layout')

@section('title', $event->exists ? 'Edit Event' : 'Tambah Event')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>{{ $event->exists ? 'Edit Event' : 'Tambah Event' }}</h1>
            <p>{{ $event->exists ? $event->name : 'Isi detail event baru.' }}</p>
        </div>
    </div>

    <form method="POST"
          action="{{ $event->exists ? route('admin.schedule.update', $event) : route('admin.schedule.store') }}"
          class="admin-form">
        @csrf
        @if ($event->exists) @method('PUT') @endif

        <div class="admin-field">
            <label for="event_date">Tanggal</label>
            <input type="date" id="event_date" name="event_date"
                   value="{{ old('event_date', optional($event->event_date)->format('Y-m-d')) }}" required>
            @error('event_date') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="name">Nama Event</label>
            <input type="text" id="name" name="name" value="{{ old('name', $event->name) }}" required>
        </div>

        <div class="admin-field">
            <label for="location">Lokasi / Titik Kumpul</label>
            <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" required>
        </div>

        <div class="admin-field">
            <label for="type">Tipe</label>
            <select id="type" name="type" required>
                @foreach (\App\Models\ScheduleEvent::TYPES as $option)
                    <option value="{{ $option }}" @selected(old('type', $event->type) === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Simpan</button>
            <a href="{{ route('admin.schedule.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
@endsection
