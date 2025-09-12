<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'move_in_date',
        'application_type',
        'full_name',
        'email',
        'phone',
        'current_address',
        'city',
        'state',
        'zip_code',
        'country',
        'citizenship',
        'date_of_birth',
        'monthly_income',
        'government_id',
        'issuing_state',
        'ssn',
        'id_front_path',
        'id_back_path',
        'selfie_path',
        'income_path',
        'payment_path',
        'status'
    ];

    protected $casts = [
        'move_in_date' => 'date',
        'date_of_birth' => 'date',
        'monthly_income' => 'decimal:2',
    ];

    public function payment()
    {
        return $this->hasOne(ApplicationPayment::class);
    }
}
