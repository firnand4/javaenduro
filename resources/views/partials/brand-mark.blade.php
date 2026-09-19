{{-- Isi tautan .brand — logo upload kalau ada, kalau tidak fallback ke logo teks bawaan. --}}
@php $siteBranding = \App\Models\SiteSetting::current(); @endphp
@if ($siteBranding->logo_url)
    {{-- Style inline sengaja diduplikasi dari .brand-logo-img — jaga-jaga kalau app.css
         ke-cache lama di server (CDN/browser) dan aturan ukurannya belum ikut ke-update. --}}
    <img src="{{ $siteBranding->logo_url }}" alt="JavaEnduro" class="brand-logo-img"
         style="height:34px; width:auto; max-width:160px; max-height:34px; object-fit:contain; display:block;">
@else
    <span class="mark"><span>JE</span></span>JAVAENDURO
@endif
