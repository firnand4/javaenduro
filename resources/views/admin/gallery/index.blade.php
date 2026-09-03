@extends('admin.layout')

@section('title', 'Galeri')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Galeri</h1>
            <p>Ubin yang tampil di section "Galeri" landing page.</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-solid btn-sm">+ Tambah Ubin</a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Caption</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>
                            @if ($item->image_url)
                                <img src="{{ $item->image_url }}" alt="" style="width:44px; height:44px; object-fit:cover; border:1px solid var(--line);">
                            @else
                                <span style="color:var(--ink-faint); font-size:0.8rem;">—</span>
                            @endif
                        </td>
                        <td>{{ $item->caption }}</td>
                        <td class="tabular">{{ $item->sort_order }}</td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" onsubmit="return confirm('Hapus ubin {{ $item->caption }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="cursor:pointer;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="wrap-cell">Belum ada ubin galeri. Tambahkan lewat tombol di atas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
