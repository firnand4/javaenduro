<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEnduro — Komunitas Trabas Malang</title>
    <meta name="description" content="JavaEnduro, komunitas trail & trabas asal Malang, Jawa Timur. Rute, jadwal event, galeri, dan cara gabung.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@500;700;800;900&family=IBM+Plex+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<nav class="nav">
    <div class="wrap nav-row">
        <a href="#top" class="brand"><span class="mark"><span>JE</span></span>JAVAENDURO</a>
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <ul class="menu">
            @foreach ($menu as $item)
                <li><a href="#{{ $item['id'] }}">{{ $item['label'] }}</a></li>
            @endforeach
        </ul>
        <a class="nav-cta" href="#komunitas">Gabung</a>
        <label class="hamburger" for="nav-toggle" aria-label="Buka menu"><span></span></label>
    </div>
</nav>

<main id="top">
    <!-- HERO -->
    <section class="hero" id="beranda">
        <div class="wrap">
            <div class="hero-grid">
                <div>
                    <span class="eyebrow">Komunitas Trail &amp; Trabas — Malang, Jawa Timur</span>
                    <h1>TRABAS<br><span class="accent-line">CHILL BROTHERHOOD</span></h1>
                    <p class="hero-sub">JavaEnduro adalah rumah bagi rider trail asal Malang yang percaya jalur terbaik bukan yang termulus — tapi yang memiliki cerita. Pasir vulkanik Semeru, tanjakan, dan estape Bromo yang Luarbiasa.</p>
                    <div class="hero-actions">
                        <a class="btn btn-solid" href="#jadwal">Lihat Jadwal Trabas</a>
                        <a class="btn btn-outline" href="#komunitas">Gabung Komunitas</a>
                    </div>
                </div>
                @if ($nextEvent)
                    <div class="hero-card">
                        <span class="eyebrow">Roadbook Terbaru</span>
                        <ul>
                            <li><span class="label">Trek berikutnya</span><span class="val">{{ $nextEvent->name }}</span></li>
                            <li><span class="label">Tanggal</span><span class="val tabular">{{ $nextEvent->full_date_label }}</span></li>
                            <li><span class="label">Titik kumpul</span><span class="val">{{ $nextEvent->location }}</span></li>
                            <li><span class="label">Tipe</span><span class="val">{{ $nextEvent->type }}</span></li>
                        </ul>
                    </div>
                @endif
            </div>

            <div class="stat-strip">
                @foreach ($stats as $stat)
                    <div class="stat"><span class="num tabular">{{ $stat['num'] }}</span><span class="lbl">{{ $stat['label'] }}</span></div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- TENTANG -->
    <section class="section" id="tentang">
        <div class="wrap about-grid">
            <div class="about-graphic" role="img" aria-label="Foto komunitas JavaEnduro" style="--graphic-caption: '{{ $about->graphic_caption }}';">
                @if ($about->image_url)
                    <img src="{{ $about->image_url }}" alt="Foto komunitas JavaEnduro">
                @endif
            </div>
            <div class="about-copy">
                <span class="eyebrow">Tentang Kami</span>
                <h2>{{ $about->heading }}</h2>
                <p>{{ $about->paragraph_1 }}</p>
                <p>{{ $about->paragraph_2 }}</p>
                <div class="value-row">
                    @foreach ($about->value_chips as $chip)
                        <span class="value-chip">{{ $chip }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- RUTE & TREK -->
    <section class="section" id="rute">
        <div class="wrap">
            <div class="section-head">
                <span class="eyebrow">Rute &amp; Trek</span>
                <h2>Jalur Kami</h2>
                <p>Empat karakter medan yang jadi destinasi wajib setiap rider JavaEnduro — Kaki Gunung Semeru, dari yang pemula sampai yang ingin Hard.</p>
            </div>
            <div class="route-grid">
                @foreach ($routes as $route)
                    <div class="route-card">
                        <span class="diff {{ $route->difficulty_class }}">{{ $route->difficulty }}</span>
                        @include('partials.trail-icon', ['icon' => $route->icon, 'class' => 'route-icon-mark'])
                        <h3>{{ $route->name }}</h3>
                        <div class="meta"><span>{{ $route->distance }}</span><span>{{ $route->elevation }}</span></div>
                        <p>{{ $route->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- JADWAL -->
    <section class="section" id="jadwal">
        <div class="wrap">
            <div class="section-head">
                <span class="eyebrow">Jadwal Event</span>
                <h2>Roadbook Musim Ini</h2>
                <p>Dari trabas rutin mingguan sampai adventure cup tahunan — semua titik kumpul dan jenis acara ada di sini.</p>
            </div>
            <div class="roadbook">
                <div class="rb-row head">
                    <span>Tanggal</span><span>Event</span><span>Lokasi</span><span>Tipe</span>
                </div>
                @foreach ($schedule as $event)
                    <div class="rb-row">
                        <span class="rb-date tabular">{{ $event->date_label }}</span>
                        <span class="rb-name">{{ $event->name }}</span>
                        <span class="rb-loc">{{ $event->location }}</span>
                        <span class="rb-type">{{ $event->type }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- GALERI -->
    <section class="section" id="galeri">
        <div class="wrap">
            <div class="section-head">
                <span class="eyebrow">Galeri</span>
                <h2>Potongan Trek Terakhir</h2>
                <p>Placeholder tekstur — ganti ubin di bawah dengan foto &amp; video dokumentasi trabas kalian.</p>
            </div>
            <div class="gal-grid">
                @foreach ($gallery as $tile)
                    <div class="gal-tile {{ $tile->image_url ? '' : $tile->tile_style }}">
                        @if ($tile->image_url)
                            <img src="{{ $tile->image_url }}" alt="{{ $tile->caption }}" loading="lazy">
                        @else
                            @include('partials.trail-icon', ['icon' => $tile->icon, 'class' => 'gal-icon'])
                        @endif
                        <span>{{ $tile->caption }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- KOMUNITAS -->
    <section class="section" id="komunitas">
        <div class="wrap">
            <div class="section-head">
                <span class="eyebrow">Komunitas</span>
                <h2>Cara Gabung</h2>
                <p>Tidak ada tes masuk. Yang kami cari cuma niat belajar medan dan mau jaga sesama rider di jalur.</p>
            </div>
            <div class="join-grid">
                @foreach ($joinSteps as $i => $step)
                    <div class="join-card">
                        <span class="idx tabular">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section class="section" id="kontak" style="border-bottom:none;">
        <div class="wrap contact">
            <div>
                <span class="eyebrow">Kontak</span>
                <h2>Sebelum Trabas, Ngobrol Dulu.</h2>
                <p class="contact-note" style="margin-top:1rem;">Ada pertanyaan soal medan, jadwal, atau mau ajak kerja sama event? Sampaikan lewat kanal berikut.</p>
            </div>
            <div class="contact-links">
                @foreach ($contacts as $contact)
                    <a href="{{ $contact['href'] }}" target="_blank" rel="noopener">{{ $contact['label'] }} <span class="sub">{{ $contact['sub'] }}</span></a>
                @endforeach
            </div>
        </div>
    </section>

    <footer>
        <div class="wrap foot-row">
            <span>© {{ date('Y') }} JAVAENDURO — Trabas Chill</span>
            <span>Basecamp Tumpang, Malang, Jawa Timur</span>
        </div>
    </footer>
</main>
</body>
</html>
