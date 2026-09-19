<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kontributor — JavaEnduro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@500;700;800;900&family=IBM+Plex+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin-login-wrap">
    <div class="admin-login-card" style="max-width:400px;">
        <a href="{{ route('home') }}" class="brand">@include('partials.brand-mark')</a>
        <p style="color:var(--ink-soft); font-size:0.92rem; margin:-1rem 0 1.4rem;">Daftar sebagai kontributor untuk upload poster event trabas kamu.</p>

        @if ($errors->any())
            <div class="admin-alert error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('contributor.register.submit') }}" class="admin-form" style="border:none; padding:0;">
            @csrf
            <div class="admin-field">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="admin-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="admin-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <span class="hint">Minimal 8 karakter.</span>
            </div>
            <div class="admin-field">
                <label for="password_confirmation">Ulangi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="admin-form-actions">
                <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Daftar</button>
            </div>
        </form>

        <p style="margin-top:1.4rem; font-size:0.88rem; color:var(--ink-soft);">
            Sudah punya akun? <a href="{{ route('contributor.login') }}" style="color:var(--accent);">Masuk di sini</a>
        </p>
    </div>
</div>
</body>
</html>
