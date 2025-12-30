<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\LoanStatus;
use App\Http\Middleware\Authenticate;

class AdminController extends Controller
{
    public function __construct()
    {
        // Proteger las rutas del panel admin con autenticación
        $this->middleware('auth');
    }

    // Mostrar todas las solicitudes
    public function index()
    {
        $loans = LoanRequest::with(['customer', 'status'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.index', compact('loans'));
    }

    // Aprobar solicitud
    public function approve($id)
    {
        $status = LoanStatus::firstOrCreate(['name' => 'aprobada']);

        $loan = LoanRequest::findOrFail($id);
        $loan->loan_status_id = $status->id;
        $loan->save();

        return redirect()->back()->with('success', 'Solicitud aprobada correctamente.');
    }

    // Rechazar solicitud
    public function reject($id)
    {
        $status = LoanStatus::firstOrCreate(['name' => 'rechazada']);

        $loan = LoanRequest::findOrFail($id);
        $loan->loan_status_id = $status->id;
        $loan->save();

        return redirect()->back()->with('success', 'Solicitud rechazada correctamente.');
    }
}
