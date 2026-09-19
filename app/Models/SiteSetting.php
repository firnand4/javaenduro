<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Singleton — pengaturan situs secara umum (logo, dst). Selalu satu baris saja.
 */
class SiteSetting extends Model
{
    protected $fillable = [
        'logo_path',
    ];

    /** Ambil satu-satunya baris pengaturan, atau buat baris kosong kalau belum pernah diisi. */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path ? Storage::disk('public')->url($this->logo_path) : null;
    }
}
