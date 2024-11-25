<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Accounts
    Route::get('/index-account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/create-account', [AccountController::class, 'create'])->name('account.create');
    Route::post('/store-account', [AccountController::class, 'store'])->name('account.store');
    Route::get('/show-account/{account}', [AccountController::class, 'show'])->name('account.show');
    Route::get('/edit-account/{account}', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/update-account/{account}', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/destroy-account/{account}', [AccountController::class, 'destroy'])->name('account.destroy');
    /* Rota para mudar situação */
    Route::get('/change-status-account/{account}', [AccountController::class, 'changeStatus'])->name('account.change-status');

    // Generate pdf
    Route::get('/generate-pdf-account', [AccountController::class, 'generatePdf'])->name('account.generate-pdf');

    // Generate excel
    Route::get('/generate-excel-account', [AccountController::class, 'generateExcel'])->name('account.generate-excel');
});

require __DIR__ . '/auth.php';