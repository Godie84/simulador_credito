<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequestFormRequest;
use App\Models\Customer;
use App\Models\LoanRequest;
use App\Models\LoanStatus;

class LoanRequestController extends Controller
{
    // Registrar nueva solicitud usando el mismo FormRequest
    public function store(LoanRequestFormRequest $request)
    {
        // Validación ya realizada por LoanRequestFormRequest
        $validated = $request->validated();

        // Crear cliente si no existe
        $customer = Customer::firstOrCreate(
            ['document_number' => $validated['document_number']],
            [
                'document_type_id' => $validated['document_type_id'],
                'first_name'      => $validated['first_name'],
                'last_name'       => $validated['last_name'],
                'gender'          => $validated['gender'],
                'birth_date'      => $validated['birth_date'],
                'phone'           => $validated['phone'],
                'email'           => $validated['email'],
            ]
        );

        // Estado pendiente
        $pendingStatus = LoanStatus::firstOrCreate(['name' => 'pendiente']);

        // Crear solicitud de préstamo
        $loan = LoanRequest::create([
            'customer_id'            => $customer->id,
            'requested_amount'       => $validated['requested_amount'],
            'number_of_installments' => $validated['number_of_installments'],
            'loan_status_id'         => $pendingStatus->id,
        ]);

        return response()->json(['message' => 'Solicitud registrada exitosamente'], 201);
    }

    // Listar todas las solicitudes con su cliente y estado
    public function index()
    {
        $loans = LoanRequest::with('customer', 'status')->get();
        return response()->json($loans, 200);
    }

    // Aprobar solicitud
    public function approve($id)
    {
        $loan = LoanRequest::findOrFail($id);
        $approvedStatus = LoanStatus::firstOrCreate(['name' => 'aprobado']);
        $loan->loan_status_id = $approvedStatus->id;
        $loan->save();

        return response()->json(['message' => 'Solicitud aprobada'], 200);
    }

    // Rechazar solicitud
    public function reject($id)
    {
        $loan = LoanRequest::findOrFail($id);
        $rejectedStatus = LoanStatus::firstOrCreate(['name' => 'rechazado']);
        $loan->loan_status_id = $rejectedStatus->id;
        $loan->save();

        return response()->json(['message' => 'Solicitud rechazada'], 200);
    }
}
