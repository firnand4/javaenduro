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
        'type',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public const TYPES = ['Latihan', 'Touring', 'Kompetisi', 'Kopdar'];

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
}
