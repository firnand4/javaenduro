{{-- Isi tautan .brand — logo upload kalau ada, kalau tidak fallback ke logo teks bawaan. --}}
@php $siteBranding = \App\Models\SiteSetting::current(); @endphp
@if ($siteBranding->logo_url)
    <img src="{{ $siteBranding->logo_url }}" alt="JavaEnduro" class="brand-logo-img">
@else
    <span class="mark"><span>JE</span></span>JAVAENDURO
@endif
