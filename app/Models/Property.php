<?php
// app/Models/Property.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'area_size',
        'price',
        'bed_room',
        'dining_room',
        'bath_room',
        'balcony',
        'property_status',
        'condition',
        'built_year',
        'dimension',
        'location',
        'address',
        'state_county',
        'city',
        'zip_code',
        'country',
        'is_featured',
        'category_id',
        'view_count',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'view_count' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'property_features');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }

    public function attachments()
    {
        return $this->hasMany(PropertyAttachment::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            $property->slug = Str::slug($property->title);
        });

        static::updating(function ($property) {
            $property->slug = Str::slug($property->title);
        });
    }
}
