<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoanRequestController;
use App\Http\Controllers\Api\SimulationController;
use App\Http\Controllers\Api\AuthController;

// Autenticación (opcional, si usas Sanctum)
Route::post('/login', [AuthController::class, 'login']);

// Simulación de crédito
Route::get('/simulate', [SimulationController::class, 'simulate']);

// Registro de solicitud de préstamo
Route::post('/loan-requests', [LoanRequestController::class, 'store'])->name('loan.store');

// Listar solicitudes
Route::get('/loan-requests', [LoanRequestController::class, 'index'])->name('loan.index');

// Aprobar / Rechazar solicitudes
Route::put('/loan-requests/{id}/approve', [LoanRequestController::class, 'approve'])->name('loan.approve');
Route::put('/loan-requests/{id}/reject', [LoanRequestController::class, 'reject'])->name('loan.reject');
