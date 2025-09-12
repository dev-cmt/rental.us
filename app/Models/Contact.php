<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'address',
        'email',
        'email2',
        'phone',
        'phone2',
        'status'
    ];
}
