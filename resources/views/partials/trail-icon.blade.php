{{-- Ikon garis dummy bertema adventure motor trail, dipilih lewat $icon. $class menentukan pembungkus (gal-icon = overlay ubin galeri, route-icon-mark = ikon inline di kartu rute). --}}
<div class="{{ $class ?? 'gal-icon' }}" aria-hidden="true">
    @switch($icon)
        @case('climb')
            {{-- Motor menanjak: dua roda + rangka + garis tanjakan --}}
            <svg viewBox="0 0 64 64">
                <path d="M4 50 L22 50 L38 20 L60 20" />
                <circle cx="14" cy="50" r="8" />
                <circle cx="46" cy="50" r="8" />
                <path d="M20 40 L34 40" />
            </svg>
            @break
        @case('forest')
            {{-- Hutan pinus: dua pohon cemara --}}
            <svg viewBox="0 0 64 64">
                <path d="M14 50 L22 32 L30 50 Z" />
                <path d="M10 56 L22 36 L34 56 Z" />
                <path d="M38 50 L46 32 L54 50 Z" />
                <path d="M34 56 L46 36 L58 56 Z" />
            </svg>
            @break
        @case('sunset')
            {{-- Matahari di balik punggungan gunung --}}
            <svg viewBox="0 0 64 64">
                <circle cx="32" cy="26" r="9" />
                <path d="M4 50 L18 32 L28 42 L38 22 L60 50 Z" />
            </svg>
            @break
        @case('convoy')
            {{-- Dua motor beriringan --}}
            <svg viewBox="0 0 64 64">
                <circle cx="12" cy="46" r="6" />
                <circle cx="24" cy="46" r="6" />
                <path d="M10 36 L28 36 L24 46" />
                <circle cx="38" cy="46" r="6" />
                <circle cx="50" cy="46" r="6" />
                <path d="M36 36 L54 36 L50 46" />
            </svg>
            @break
        @case('river')
            {{-- Riak sungai bertingkat --}}
            <svg viewBox="0 0 64 64">
                <path d="M4 22c6-6 12-6 18 0s12 6 18 0 12-6 18 0" />
                <path d="M4 34c6-6 12-6 18 0s12 6 18 0 12-6 18 0" />
                <path d="M4 46c6-6 12-6 18 0s12 6 18 0 12-6 18 0" />
            </svg>
            @break
        @case('volcano')
            {{-- Kerucut gunung berapi dengan asap --}}
            <svg viewBox="0 0 64 64">
                <path d="M6 52 L24 20 L30 30 L36 16 L58 52 Z" />
                <path d="M33 10c2 2 -2 3 0 5s-2 3 0 5" />
            </svg>
            @break
        @case('camp')
            {{-- Tenda basecamp --}}
            <svg viewBox="0 0 64 64">
                <path d="M32 12 L54 52 L10 52 Z" />
                <path d="M32 12 L32 52" />
                <path d="M21 52 L32 32 L43 52" />
            </svg>
            @break
        @case('trophy')
            {{-- Trofi Adventure Cup --}}
            <svg viewBox="0 0 64 64">
                <path d="M20 12h24v14a12 12 0 0 1-24 0z" />
                <path d="M20 16h-6a6 6 0 0 0 6 10" />
                <path d="M44 16h6a6 6 0 0 1-6 10" />
                <path d="M32 38v10" />
                <path d="M24 54h16" />
                <path d="M27 48h10l2 6h-14z" />
            </svg>
            @break
    @endswitch
</div>
