@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Dashboard</h1>
            <p>Kelola konten yang tampil di landing page JavaEnduro.</p>
        </div>
        <a href="{{ route('admin.about.edit') }}" class="btn btn-outline btn-sm">Edit Tentang Kami</a>
    </div>

    <div class="admin-kpis">
        <div class="admin-kpi">
            <span class="num tabular">{{ $routeCount }}</span>
            <span class="lbl">Rute &amp; trek</span>
        </div>
        <div class="admin-kpi">
            <span class="num tabular">{{ $eventCount }}</span>
            <span class="lbl">Event terjadwal</span>
        </div>
        <div class="admin-kpi">
            <span class="num tabular">{{ $galleryCount }}</span>
            <span class="lbl">Ubin galeri</span>
        </div>
    </div>

    <div class="admin-table-wrap" style="max-width:640px;">
        <table class="admin-table">
            <tbody>
                <tr>
                    <th>Event berikutnya</th>
                    <td>
                        @if ($nextEvent)
                            {{ $nextEvent->name }} — {{ $nextEvent->full_date_label }} ({{ $nextEvent->location }})
                        @else
                            Belum ada event mendatang.
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
