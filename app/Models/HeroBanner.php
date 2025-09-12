<?php
// app/Models/HeroBanner.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_text',
        'badge_color',
        'title',
        'description',
        'image',
        'search_locations',
        'popular_searches',
        'is_active'
    ];

    protected $casts = [
        'search_locations' => 'array',
        'popular_searches' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get the active hero banner
     */
    public static function getActive()
    {
        return static::where('is_active', true)->first();
    }
}
