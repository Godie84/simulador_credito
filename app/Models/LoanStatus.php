<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanStatus extends Model
{
    /** @use HasFactory<\Database\Factories\LoanStatusFactory> */
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención de Laravel)
    protected $table = 'loan_statuses';

    // Los campos que se pueden asignar masivamente
    protected $fillable = ['name'];

    // Relación con LoanRequest: Un LoanStatus tiene muchas solicitudes de préstamo
    public function loanRequests()
    {
        return $this->hasMany(LoanRequest::class);
    }

}
