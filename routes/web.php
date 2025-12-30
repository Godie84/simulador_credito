<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\LoanRequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (sin login)
|--------------------------------------------------------------------------
*/

// Simulador visible para TODOS
Route::get('/', [PublicController::class, 'simulator'])->name('simulator');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/loan-requests', [LoanRequestController::class, 'store'])
    ->name('loan.register');

/*
|--------------------------------------------------------------------------
| RUTAS PARA USUARIOS AUTENTICADOS (SOLICITANTE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard del solicitante (puede ser el mismo simulador)
    Route::get('/dashboard', [PublicController::class, 'simulator'])->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta pública del simulador (para el logo, invitados y usuarios)
Route::get('/simulator', [PublicController::class, 'simulator'])->name('simulator');

// Ruta protegida para usuarios logueados (simulador / dashboard)
Route::middleware(['auth'])->get('/dashboard', [PublicController::class, 'simulator'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| RUTAS SOLO PARA ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/approve/{loan}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/reject/{loan}', [AdminController::class, 'reject'])->name('admin.reject');
});

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN (Breeze / Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
