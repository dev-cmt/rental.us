<?php
// app/Models/PropertyAttachment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'name', 'file_path'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
