<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TrailRoute extends Model
{
    protected $fillable = [
        'name',
        'difficulty',
        'icon',
        'distance',
        'elevation',
        'description',
        'sort_order',
    ];

    /** Ikon yang tersedia — dipakai bareng partial resources/views/partials/trail-icon.blade.php */
    public const ICONS = ['climb', 'forest', 'sunset', 'convoy', 'river', 'volcano', 'camp', 'trophy'];

    public const DIFFICULTIES = ['Pemula', 'Menengah', 'Ekstrem'];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /** Kelas CSS badge untuk level "Ekstrem" (dipakai di route-card). */
    public function getDifficultyClassAttribute(): string
    {
        return $this->difficulty === 'Ekstrem' ? 'ext' : '';
    }
}
