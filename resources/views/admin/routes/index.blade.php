@extends('admin.layout')

@section('title', 'Rute & Trek')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Rute &amp; Trek</h1>
            <p>Daftar jalur yang tampil di section "Rute & Trek" landing page.</p>
        </div>
        <a href="{{ route('admin.routes.create') }}" class="btn btn-solid btn-sm">+ Tambah Rute</a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Level</th>
                    <th>Jarak</th>
                    <th>Elevasi</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($routes as $route)
                    <tr>
                        <td>{{ $route->name }}</td>
                        <td>{{ $route->difficulty }}</td>
                        <td class="tabular">{{ $route->distance }}</td>
                        <td class="tabular">{{ $route->elevation }}</td>
                        <td class="tabular">{{ $route->sort_order }}</td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('admin.routes.edit', $route) }}" class="btn btn-outline btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.routes.destroy', $route) }}" onsubmit="return confirm('Hapus rute {{ $route->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="cursor:pointer;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="wrap-cell">Belum ada rute. Tambahkan lewat tombol di atas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
