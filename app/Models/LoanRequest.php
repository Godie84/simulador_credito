<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    /** @use HasFactory<\Database\Factories\LoanRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'requested_amount',
        'number_of_installments',
        'loan_status_id'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function status() {
        return $this->belongsTo(LoanStatus::class, 'loan_status_id');
    }
}
