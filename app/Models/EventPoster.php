<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class EventPoster extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
        'title',
        'category',
        'city',
        'kecamatan',
        'province',
        'event_date',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public const STATUSES = ['pending', 'approved', 'rejected', 'archived'];

    /** Urutan ini juga dipakai sebagai urutan tampil grup di landing page. */
    public const CATEGORIES = ['Trabas Baksos Adventure', 'Race Adventure'];

    public function contributor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    /** Antrean kerja admin: semua poster kecuali yang sudah diarsipkan. */
    public function scopeNotArchived(Builder $query): Builder
    {
        return $query->where('status', '!=', 'archived');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? Storage::disk('public')->url($this->image_path) : null;
    }

    /** Mis. "20 SEP 2026" — dipakai di kartu poster publik & daftar admin. */
    public function getDateLabelAttribute(): string
    {
        return strtoupper($this->event_date->locale('id')->isoFormat('DD MMM YYYY'));
    }

    /** Mis. "Lowokwaru, Malang, Jawa Timur" — gabungan kecamatan/kota/provinsi buat ditampilkan. */
    public function getLocationLabelAttribute(): string
    {
        return collect([$this->kecamatan, $this->city, $this->province])
            ->filter()
            ->implode(', ');
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

    /** Fallback ke lokasi untuk poster lama yang diunggah sebelum field judul ada. */
    public function getDisplayTitleAttribute(): string
    {
        return $this->title ?: $this->location_label;
    }
}
