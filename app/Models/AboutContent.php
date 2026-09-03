<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Singleton — isi section "Tentang Kami" di landing page. Selalu satu baris saja.
 */
class AboutContent extends Model
{
    protected $fillable = [
        'heading',
        'paragraph_1',
        'paragraph_2',
        'value_chips',
        'graphic_caption',
        'image_path',
    ];

    protected $casts = [
        'value_chips' => 'array',
    ];

    /** URL publik foto, atau null kalau masih pakai ilustrasi kontur bawaan. */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? Storage::disk('public')->url($this->image_path) : null;
    }

    /** Ambil satu-satunya baris konten, atau buat default kalau belum pernah diisi. */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'heading' => 'Bukan Klub Motor. Ini Barisan Penerabas.',
            'paragraph_1' => 'JavaEnduro lahir dari kebiasaan sekelompok rider Malang yang lebih sering pulang berlumpur daripada berdebu.',
            'paragraph_2' => 'Kami bukan komunitas balap. Kami komunitas yang mengukur perjalanan dari seberapa jujur medannya, bukan seberapa cepat sampainya.',
            'value_chips' => ['Solidaritas Konvoi', 'Safety Riding', 'Leave No Trace', 'Regenerasi Rider'],
            'graphic_caption' => 'SEMERU · BROMO · KAWI · ARJUNO',
        ]);
    }
}
