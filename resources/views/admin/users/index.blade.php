@extends('admin.layout')

@section('title', 'Pengguna')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Pengguna</h1>
            <p>Semua akun superadmin &amp; kontributor. Ganti role atau reset password lewat kolom Aksi.</p>
        </div>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }} @if ($user->id === auth()->id()) <span style="color:var(--ink-faint); font-size:0.78rem;">(kamu)</span> @endif</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="status-badge {{ $user->role === 'superadmin' ? 'approved' : 'pending' }}">{{ ucfirst($user->role) }}</span></td>
                        <td class="tabular">{{ $user->created_at->locale('id')->isoFormat('DD MMM YYYY') }}</td>
                        <td>
                            <div style="display:flex; flex-direction:column; gap:0.6rem; align-items:flex-start;">
                                @if ($user->id === auth()->id())
                                    <span style="color:var(--ink-faint); font-size:0.8rem;">Tidak bisa ubah role sendiri</span>
                                @else
                                    <form method="POST" action="{{ route('admin.users.role.update', $user) }}" class="row-actions" style="align-items:center;">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" style="background:var(--bg); border:1px solid var(--line-strong); color:var(--ink); padding:0.4rem 0.6rem; font-family:var(--font-body); font-size:0.85rem;">
                                            <option value="contributor" @selected($user->role === 'contributor')>Contributor</option>
                                            <option value="superadmin" @selected($user->role === 'superadmin')>Superadmin</option>
                                        </select>
                                        <button type="submit" class="btn btn-outline btn-sm" style="cursor:pointer;">Simpan</button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.users.password.edit', $user) }}" class="btn btn-danger btn-sm">Reset Password</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="wrap-cell">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
