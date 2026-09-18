<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class TrailRoutePhoto extends Model
{
    protected $fillable = [
        'trail_route_id',
        'image_path',
        'sort_order',
    ];

    public function route(): BelongsTo
    {
        return $this->belongsTo(TrailRoute::class, 'trail_route_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? Storage::disk('public')->url($this->image_path) : null;
    }
}
