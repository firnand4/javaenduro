<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Singleton — video latar loop di section Beranda. Selalu satu baris saja.
 */
class HeroSetting extends Model
{
    protected $fillable = [
        'video_path',
    ];

    /** Ambil satu-satunya baris pengaturan, atau buat baris kosong kalau belum pernah diisi. */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    public function getVideoUrlAttribute(): ?string
    {
        return $this->video_path ? Storage::disk('public')->url($this->video_path) : null;
    }
}
