<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class TrailRoute extends Model
{
    protected $fillable = [
        'name',
        'difficulty',
        'icon',
        'distance',
        'elevation',
        'description',
        'map_image_path',
        'teaser_video_path',
        'teaser_youtube_url',
        'sort_order',
    ];

    /** Ikon yang tersedia — dipakai bareng partial resources/views/partials/trail-icon.blade.php */
    public const ICONS = ['climb', 'forest', 'sunset', 'convoy', 'river', 'volcano', 'camp', 'trophy'];

    public const DIFFICULTIES = ['Pemula', 'Menengah', 'Ekstrem'];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(TrailRoutePhoto::class)->orderBy('sort_order')->orderBy('id');
    }

    /** Kelas CSS badge untuk level "Ekstrem" (dipakai di route-card). */
    public function getDifficultyClassAttribute(): string
    {
        return $this->difficulty === 'Ekstrem' ? 'ext' : '';
    }

    public function getMapImageUrlAttribute(): ?string
    {
        return $this->map_image_path ? Storage::disk('public')->url($this->map_image_path) : null;
    }

    public function getTeaserVideoUrlAttribute(): ?string
    {
        return $this->teaser_video_path ? Storage::disk('public')->url($this->teaser_video_path) : null;
    }

    /** Ekstrak ID video dari berbagai format link YouTube (watch, youtu.be, shorts, embed). */
    public function getTeaserYoutubeEmbedUrlAttribute(): ?string
    {
        if (! $this->teaser_youtube_url) {
            return null;
        }

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]{11})/', $this->teaser_youtube_url, $matches)) {
            return "https://www.youtube.com/embed/{$matches[1]}";
        }

        return null;
    }

    /** True kalau ada video teaser dari sumber mana pun (upload atau YouTube). */
    public function getHasTeaserVideoAttribute(): bool
    {
        return (bool) ($this->teaser_video_url || $this->teaser_youtube_embed_url);
    }

    /**
     * Kalimat pertama saja dari deskripsi — dipakai sebagai teaser di kartu rute.
     * Deskripsi lengkapnya tetap tampil utuh di dialog detail waktu kartu diklik.
     */
    public function getShortDescriptionAttribute(): string
    {
        if (preg_match('/^(.+?[.!?])(\s|$)/su', trim($this->description), $matches)) {
            return $matches[1];
        }

        return $this->description;
    }
}
