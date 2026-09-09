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
        <a class="nav-cta" href="{{ route('contributor.register') }}">Daftar</a>
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
                        <a class="btn btn-outline" href="{{ route('contributor.dashboard') }}">Jadi Kontributor</a>
                    </div>
                </div>
                @if ($nextEvent)
                    <div class="hero-card">
                        <span class="eyebrow">Roadbook Terbaru</span>
                        <ul>
                            <li><span class="label">Trek berikutnya</span><span class="val">{{ $nextEvent->name }}</span></li>
                            <li><span class="label">Tanggal</span><span class="val tabular">{{ $nextEvent->full_date_label }}</span></li>
                            <li><span class="label">Titik kumpul</span><span class="val">{{ $nextEvent->location }}</span></li>
                            <li><span class="label">Kategori</span><span class="val">{{ $nextEvent->category }}</span></li>
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
                <p>5 event paling dekat ke hari ini per kategori — tanggal, judul, dan lokasinya.</p>
            </div>

            @foreach (\App\Models\ScheduleEvent::CATEGORIES as $category)
                @php $group = $roadbookByCategory[$category]; @endphp
                <div class="category-block">
                    <h3 class="category-title">{{ $category }}</h3>
                    <p class="category-desc">{{ \App\Models\ScheduleEvent::CATEGORY_DESCRIPTIONS[$category] }}</p>

                    @if ($group['items']->isEmpty())
                        <p class="poster-empty">Belum ada event di kategori ini.</p>
                    @else
                        <div class="roadbook">
                            <div class="rb-row head">
                                <span>Tanggal</span><span>Event</span><span>Lokasi</span>
                            </div>
                            @foreach ($group['items'] as $item)
                                <div class="rb-row">
                                    <span class="rb-date tabular">{{ $item['date_label'] }}</span>
                                    <span class="rb-name">{{ $item['title'] }}</span>
                                    <span class="rb-loc">{{ $item['location'] }}</span>
                                </div>
                            @endforeach
                        </div>
                        @if ($group['seeAllUrl'] && $group['total'] > 5)
                            <a href="{{ $group['seeAllUrl'] }}" class="btn btn-outline btn-sm" style="margin-top:1.1rem;">Lihat Semua Event</a>
                        @endif
                    @endif
                </div>
            @endforeach
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

    <!-- JADWAL EVENT TRABAS (poster kontributor) -->
    <section class="section" id="event-trabas">
        <div class="wrap">
            <div class="section-head poster-head">
                <div>
                    <span class="eyebrow">Jadwal Event Trabas</span>
                    <h2>Poster dari Kontributor</h2>
                    <p>Event trabas yang diunggah langsung oleh rider lain se-Indonesia — setiap poster sudah divalidasi superadmin sebelum tayang di sini.</p>
                </div>
                <a href="{{ route('contributor.dashboard') }}" class="btn btn-solid">Upload Poster Event</a>
            </div>

            @foreach (\App\Models\EventPoster::CATEGORIES as $category)
                @php $posters = $eventPostersByCategory->get($category, collect()); @endphp
                <div class="category-block" id="poster-{{ \Illuminate\Support\Str::slug($category) }}">
                    <h3 class="category-title">{{ $category }}</h3>
                    @if ($posters->isEmpty())
                        <p class="poster-empty">Belum ada poster event yang tervalidasi di kategori ini. Jadi kontributor pertama yang mengunggah!</p>
                    @else
                        <div class="poster-grid">
                            @foreach ($posters as $poster)
                                <button type="button" class="poster-card js-poster-trigger"
                                        data-image="{{ $poster->image_url }}"
                                        data-title="{{ $poster->display_title }}"
                                        data-date="{{ $poster->date_label }}"
                                        data-loc="{{ $poster->location_label }}"
                                        data-category="{{ $poster->category }}"
                                        aria-label="Lihat poster {{ $poster->display_title }} di {{ $poster->location_label }}, {{ $poster->date_label }}">
                                    <img src="{{ $poster->image_url }}" alt="Poster event trabas di {{ $poster->location_label }}" loading="lazy">
                                    <div class="poster-meta">
                                        <span class="poster-date tabular">{{ $poster->date_label }}</span>
                                        <span class="poster-loc">{{ $poster->location_label }}</span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <!-- KONTAK -->
    <section class="section" id="kontak" style="border-bottom:none;">
        <div class="wrap">
            <div class="contact">
                <div>
                    <span class="eyebrow">Kontak</span>
                    <h2>Basecamp Javaenduro</h2>
                    <p class="contact-note" style="margin-top:1rem;">Ada pertanyaan soal medan, jadwal, atau mau ajak kerja sama event? Sampaikan lewat kanal berikut.</p>

                    <div class="contact-map">
                        <iframe
                            src="https://www.google.com/maps?q=-8.0717568,112.7572785&z=17&output=embed"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                            title="Peta lokasi Javaenduro Basecamp"></iframe>
                        <a class="contact-map-link" href="https://maps.app.goo.gl/KRxRi2roodBkAqrw9" target="_blank" rel="noopener">Buka di Google Maps →</a>
                    </div>
                </div>
                <div class="contact-links">
                    @foreach ($contacts as $contact)
                        <a href="{{ $contact['href'] }}" target="_blank" rel="noopener">{{ $contact['label'] }} <span class="sub">{{ $contact['sub'] }}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="wrap foot-row">
            <span>© {{ date('Y') }} JAVAENDURO — Trabas Chill</span>
            <span>Basecamp Poncokusumo, Malang, Jawa Timur</span>
        </div>
    </footer>
</main>

<!-- Lightbox poster: dipicu klik kartu poster di section Jadwal Event Trabas -->
<dialog id="poster-lightbox" class="poster-lightbox">
    <button type="button" class="poster-lightbox-close" aria-label="Tutup">&times;</button>
    <img id="poster-lightbox-img" src="" alt="">
    <div class="poster-lightbox-meta">
        <span class="eyebrow" id="poster-lightbox-category"></span>
        <span class="poster-lightbox-title" id="poster-lightbox-title"></span>
        <span class="poster-lightbox-loc" id="poster-lightbox-loc"></span>
        <span class="poster-lightbox-date tabular" id="poster-lightbox-date"></span>
    </div>
</dialog>

<script>
    (function () {
        var lightbox = document.getElementById('poster-lightbox');
        if (!lightbox) return;

        var img = document.getElementById('poster-lightbox-img');
        var title = document.getElementById('poster-lightbox-title');
        var loc = document.getElementById('poster-lightbox-loc');
        var date = document.getElementById('poster-lightbox-date');
        var category = document.getElementById('poster-lightbox-category');

        document.querySelectorAll('.js-poster-trigger').forEach(function (card) {
            card.addEventListener('click', function () {
                img.src = card.dataset.image;
                img.alt = 'Poster ' + card.dataset.title;
                title.textContent = card.dataset.title;
                loc.textContent = card.dataset.loc;
                date.textContent = card.dataset.date;
                category.textContent = card.dataset.category;
                lightbox.showModal();
            });
        });

        lightbox.querySelector('.poster-lightbox-close').addEventListener('click', function () {
            lightbox.close();
        });

        // Klik area gelap di luar poster (backdrop) ikut menutup dialog.
        lightbox.addEventListener('click', function (e) {
            var r = lightbox.getBoundingClientRect();
            var insideDialog = e.clientY >= r.top && e.clientY <= r.bottom && e.clientX >= r.left && e.clientX <= r.right;
            if (!insideDialog) lightbox.close();
        });
    })();
</script>
</body>
</html>
