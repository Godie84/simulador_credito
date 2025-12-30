<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    // Indica que la tabla es 'customers' (aunque Laravel lo deduce automáticamente).
    protected $table = 'customers';

    // Definir los atributos que pueden ser asignados masivamente (mass assignable).
    protected $fillable = [
        'document_type_id',
        'document_number',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'phone',
        'email',
    ];

    // Para manejar el tipo de fecha, se especifica que 'birth_date' es una fecha.
    protected $dates = [
        'birth_date',
    ];

    // Definir la relación con 'document_type'
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

}
