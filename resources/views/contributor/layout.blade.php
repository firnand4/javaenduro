<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kontributor') — JavaEnduro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@500;700;800;900&family=IBM+Plex+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
</head>
<body>
<header class="contrib-topbar">
    <a href="{{ route('home') }}" class="brand">@include('partials.brand-mark')</a>
    <div class="admin-whoami" style="flex-direction:row; align-items:center; border:none; background:none; padding:0;">
        <span class="admin-whoami-name">{{ auth()->user()->name }}</span>
        <span class="status-badge {{ auth()->user()->isSuperadmin() ? 'approved' : 'pending' }}">{{ ucfirst(auth()->user()->role) }}</span>
        <form method="POST" action="{{ route('contributor.logout') }}">
            @csrf
            <button type="submit" class="admin-logout" style="cursor:pointer;">Keluar</button>
        </form>
    </div>
</header>
<main class="contrib-main">
    @if (session('status'))
        <div class="admin-alert">{{ session('status') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
