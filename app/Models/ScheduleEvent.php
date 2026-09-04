<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ScheduleEvent extends Model
{
    protected $fillable = [
        'event_date',
        'name',
        'location',
        'category',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /** Urutan ini juga dipakai sebagai urutan tampil grup di landing page. */
    public const CATEGORIES = ['Open Trip Trabas Javaenduro', 'Trabas Baksos Adventure', 'Race Adventure'];

    /** Keterangan singkat di bawah judul tiap kategori pada section "Roadbook Musim Ini". */
    public const CATEGORY_DESCRIPTIONS = [
        'Open Trip Trabas Javaenduro' => 'Jadwal event open trabas by Javaenduro.',
        'Trabas Baksos Adventure' => 'Jadwal Trabas Baksos Adventure seperti pembangunan masjid atau donasi pada hal tertentu.',
        'Race Adventure' => 'Jadwal Race atau event Adventure MAT, Hiu Selatan, KWB, atau event yang tidak berhubungan dengan donasi.',
    ];

    public function scopeUpcomingFirst(Builder $query): Builder
    {
        return $query->orderBy('event_date');
    }

    /** Format tanggal singkat ala roadbook, mis. "20 SEP". */
    public function getDateLabelAttribute(): string
    {
        return strtoupper($this->event_date->locale('id')->isoFormat('DD MMM'));
    }

    /** Format tanggal lengkap untuk kartu roadbook di hero, mis. "20 Sep 2026". */
    public function getFullDateLabelAttribute(): string
    {
        return $this->event_date->locale('id')->isoFormat('DD MMM YYYY');
    }

    /** Dibandingkan per tanggal (bukan jam) — event hari ini masih dianggap "Akan Datang". */
    public function getIsUpcomingAttribute(): bool
    {
        return $this->event_date->greaterThanOrEqualTo(today());
    }

    public function getEventStatusLabelAttribute(): string
    {
        return $this->is_upcoming ? 'Akan Datang' : 'Selesai';
    }
}
