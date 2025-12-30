<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentTypeFactory> */
    use HasFactory;

    // La tabla a la que se refiere este modelo. Laravel lo deduce automáticamente,
    // pero aquí se pone por si deseas especificarlo explícitamente.
    protected $table = 'document_types';

    // Indicar los campos que pueden ser asignados masivamente (Mass Assignment)
    protected $fillable = [
        'name',  // Solo 'name' es asignable
    ];

}
