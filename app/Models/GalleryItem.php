<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryItem extends Model
{
    protected $fillable = [
        'caption',
        'icon',
        'tile_style',
        'image_path',
        'sort_order',
    ];

    /** Slug gaya ubin — tiap slug punya gradasi warna sendiri di public/css/app.css (.gal-tile.t1 dst). Dipakai sebagai latar saat belum ada foto. */
    public const TILE_STYLES = ['t1', 't2', 't3', 't4', 't5', 't6', 't7', 't8'];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /** URL publik foto, atau null kalau ubin ini masih pakai placeholder gradasi + ikon. */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? Storage::disk('public')->url($this->image_path) : null;
    }
}
