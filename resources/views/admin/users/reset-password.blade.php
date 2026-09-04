@extends('admin.layout')

@section('title', 'Reset Password')

@section('content')
    <div class="admin-topbar">
        <div>
            <h1>Reset Password</h1>
            <p>{{ $user->name }} ({{ $user->email }})</p>
        </div>
    </div>

    <div class="admin-alert">
        Password lama tidak bisa dilihat — cuma tersimpan dalam bentuk hash yang tidak bisa dibalik.
        Set password baru di bawah, lalu sampaikan ke yang bersangkutan lewat jalur aman (WA/japri langsung).
    </div>

    <form method="POST" action="{{ route('admin.users.password.update', $user) }}" class="admin-form">
        @csrf
        @method('PATCH')

        <div class="admin-field">
            <label for="password">Password Baru</label>
            <input type="password" id="password" name="password" required autofocus>
            <span class="hint">Minimal 8 karakter.</span>
            @error('password') <span class="field-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-field">
            <label for="password_confirmation">Ulangi Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Simpan Password Baru</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
@endsection
