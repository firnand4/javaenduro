@extends('admin.layout')

@section('title', 'Jadwal Event')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Jadwal Event</h1>
            <p>Roadbook yang tampil di section "Jadwal" landing page, terurut otomatis dari tanggal terdekat.</p>
        </div>
        <a href="{{ route('admin.schedule.create') }}" class="btn btn-solid btn-sm">+ Tambah Event</a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Event</th>
                    <th>Lokasi</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td class="tabular">{{ $event->date_label }} {{ $event->event_date->year }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->type }}</td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('admin.schedule.edit', $event) }}" class="btn btn-outline btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.schedule.destroy', $event) }}" onsubmit="return confirm('Hapus event {{ $event->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="cursor:pointer;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="wrap-cell">Belum ada event. Tambahkan lewat tombol di atas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
