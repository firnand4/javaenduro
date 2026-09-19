<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin — JavaEnduro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@500;700;800;900&family=IBM+Plex+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin-login-wrap">
    <div class="admin-login-card">
        <a href="{{ route('home') }}" class="brand">@include('partials.brand-mark')</a>

        @auth
            <div class="admin-alert">
                Kamu sedang login sebagai <strong>{{ auth()->user()->name }}</strong> ({{ ucfirst(auth()->user()->role) }}).
                Masuk dengan akun superadmin di bawah untuk ganti sesi.
            </div>
        @endauth

        @if ($errors->any())
            <div class="admin-alert error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="admin-form" style="border:none; padding:0;">
            @csrf
            <div class="admin-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="admin-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="admin-form-actions">
                <button type="submit" class="btn btn-solid" style="border:none; cursor:pointer;">Masuk</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
