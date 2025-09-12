<?php
// app/Models/PropertyFeature.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFeature extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'feature_id'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
