<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentType;

class PublicController extends Controller
{
    // Muestra el formulario del simulador
    public function simulator()
    {
        $documentTypes = \App\Models\DocumentType::all();
        return view('simulator', compact('documentTypes'));
    }
}
