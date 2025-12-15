<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\MoneyFlowController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Dashboard
Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // === PROFILE ===
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/moneyflow', [MoneyFlowController::class, 'index'])->name('moneyflow');
    Route::post('/moneyflow', [MoneyFlowController::class, 'store'])->name('moneyflow.store');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan');
    
    // === TABUNGAN ===
    Route::get('/savings', [SavingController::class, 'index'])->name('savings.index');
    Route::get('/savings/create', [SavingController::class, 'create'])->name('savings.create');
    Route::post('/savings', [SavingController::class, 'store'])->name('savings.store');
    Route::get('/savings/{saving}', [SavingController::class, 'show'])->name('savings.show');
    Route::post('/savings/{saving}/transactions', [SavingController::class, 'addTransaction'])->name('savings.addTransaction');

    // === HUTANG / PIUTANG ===
    Route::get('/debts', [DebtController::class, 'index'])->name('debts.index');
    Route::get('/debts/create', [DebtController::class, 'create'])->name('debts.create');
    Route::post('/debts', [DebtController::class, 'store'])->name('debts.store');
    Route::get('/debts/{debt}', [DebtController::class, 'show'])->name('debts.show');
    Route::post('/debts/{debt}/transactions', [DebtController::class, 'addTransaction'])->name('debts.addTransaction');
});

require __DIR__.'/auth.php';