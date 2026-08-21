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
                    <h1>TRABAS<br><span class="accent-line">TANPA KOMPROMI</span></h1>
                    <p class="hero-sub">JavaEnduro adalah rumah bagi rider trail asal Malang yang percaya jalur terbaik bukan yang termulus — tapi yang paling jujur. Pasir vulkanik Semeru, tanjakan Kawi, dan susur Kali Brantas adalah gurunya.</p>
                    <div class="hero-actions">
                        <a class="btn btn-solid" href="#jadwal">Lihat Jadwal Trabas</a>
                        <a class="btn btn-outline" href="#komunitas">Gabung Komunitas</a>
                    </div>
                </div>
                <div class="hero-card">
                    <span class="eyebrow">Roadbook Terbaru</span>
                    <ul>
                        <li><span class="label">Trek berikutnya</span><span class="val">{{ $nextEvent['route'] }}</span></li>
                        <li><span class="label">Tanggal</span><span class="val tabular">{{ $nextEvent['date'] }}</span></li>
                        <li><span class="label">Titik kumpul</span><span class="val">{{ $nextEvent['meeting_point'] }}</span></li>
                        <li><span class="label">Level</span><span class="val">{{ $nextEvent['level'] }}</span></li>
                    </ul>
                </div>
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
            <div class="about-graphic" role="img" aria-label="Ilustrasi kontur lereng gunung"></div>
            <div class="about-copy">
                <span class="eyebrow">Tentang Kami</span>
                <h2>Bukan Klub Motor. Ini Barisan Penerabas.</h2>
                <p>JavaEnduro lahir dari kebiasaan sekelompok rider Malang yang lebih sering pulang berlumpur daripada berdebu. Kami memetakan jalur yang tidak ada di GPS mana pun — dari kaki Semeru sampai hutan pinus Cangar.</p>
                <p>Kami bukan komunitas balap. Kami komunitas yang mengukur perjalanan dari seberapa jujur medannya, bukan seberapa cepat sampainya. Setiap member wajib bawa pulang sampahnya sendiri — trek yang kami rawat hari ini yang akan kami trabas lagi tahun depan.</p>
                <div class="value-row">
                    <span class="value-chip">Solidaritas Konvoi</span>
                    <span class="value-chip">Safety Riding</span>
                    <span class="value-chip">Leave No Trace</span>
                    <span class="value-chip">Regenerasi Rider</span>
                </div>
            </div>
        </div>
    </section>

    <!-- RUTE & TREK -->
    <section class="section" id="rute">
        <div class="wrap">
            <div class="section-head">
                <span class="eyebrow">Rute &amp; Trek</span>
                <h2>Jalur yang Kami Rawat</h2>
                <p>Empat karakter medan yang jadi kurikulum wajib setiap rider JavaEnduro — dari kaki Semeru sampai punggungan Kawi, dari yang ramah pemula sampai yang cuma layak ditawarkan ke yang sudah kenyang lumpur.</p>
            </div>
            <div class="route-grid">
                @foreach ($routes as $route)
                    <div class="route-card">
                        <span class="diff {{ $route['difficulty_class'] }}">{{ $route['difficulty'] }}</span>
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            @foreach ($route['paths'] as $d)
                                <path d="{{ $d }}"/>
                            @endforeach
                        </svg>
                        <h3>{{ $route['name'] }}</h3>
                        <div class="meta"><span>{{ $route['distance'] }}</span><span>{{ $route['elevation'] }}</span></div>
                        <p>{{ $route['desc'] }}</p>
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
                        <span class="rb-date tabular">{{ $event['date'] }}</span>
                        <span class="rb-name">{{ $event['name'] }}</span>
                        <span class="rb-loc">{{ $event['location'] }}</span>
                        <span class="rb-type">{{ $event['type'] }}</span>
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
                    <div class="gal-tile {{ $tile['class'] }}">
                        @include('partials.trail-icon', ['icon' => $tile['icon']])
                        <span>{{ $tile['caption'] }}</span>
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
            <span>© {{ date('Y') }} JAVAENDURO — Trabas Tanpa Kompromi</span>
            <span>Basecamp Tumpang, Malang, Jawa Timur</span>
        </div>
    </footer>
</main>
</body>
</html>
