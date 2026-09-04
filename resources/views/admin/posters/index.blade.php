@extends('admin.layout')

@section('title', 'Validasi Poster Event')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>{{ $showArchived ? 'Arsip Poster' : 'Validasi Poster Event' }}</h1>
            <p>
                @if ($showArchived)
                    Poster yang tidak valid dan sudah diarsipkan — tidak tampil di antrean validasi maupun landing page.
                @else
                    Poster yang diunggah kontributor. Ubah status jadi Approved supaya tayang di section "Jadwal Event Trabas" landing page.
                @endif
            </p>
        </div>
        @if ($showArchived)
            <a href="{{ route('admin.posters.index') }}" class="btn btn-outline btn-sm">← Kembali ke Antrean</a>
        @else
            <a href="{{ route('admin.posters.index', ['arsip' => 1]) }}" class="btn btn-outline btn-sm">Lihat Arsip ({{ $archivedCount }})</a>
        @endif
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Poster</th>
                    <th>Judul</th>
                    <th>Kontributor</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Tanggal Event</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posters as $poster)
                    <tr>
                        <td><img src="{{ $poster->image_url }}" alt="" style="width:44px; height:56px; object-fit:cover; border:1px solid var(--line);"></td>
                        <td>{{ $poster->display_title }}</td>
                        <td>
                            {{ $poster->contributor->name }}
                            <div style="color:var(--ink-faint); font-size:0.78rem;">{{ $poster->contributor->email }}</div>
                        </td>
                        <td>{{ $poster->category }}</td>
                        <td>{{ $poster->location_label }}</td>
                        <td class="tabular">{{ $poster->date_label }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.posters.status.update', $poster) }}" class="row-actions" style="align-items:center;">
                                @csrf
                                @method('PATCH')
                                <select name="status" style="background:var(--bg); border:1px solid var(--line-strong); color:var(--ink); padding:0.4rem 0.6rem; font-family:var(--font-body); font-size:0.85rem;">
                                    @foreach (\App\Models\EventPoster::STATUSES as $option)
                                        <option value="{{ $option }}" @selected($poster->status === $option)>{{ ucfirst($option) }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline btn-sm" style="cursor:pointer;">Simpan</button>
                            </form>
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('admin.posters.edit', $poster) }}" class="btn btn-outline btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.posters.destroy', $poster) }}" onsubmit="return confirm('Hapus permanen poster dari {{ $poster->location_label }}? Tindakan ini tidak bisa dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="cursor:pointer;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="wrap-cell">
                        {{ $showArchived ? 'Belum ada poster yang diarsipkan.' : 'Belum ada poster yang diunggah kontributor.' }}
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
