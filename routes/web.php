<?php

use App\Http\Controllers\AlimentacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inventario y producción (todos los roles)
    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('lotes', LoteController::class);
    Route::get('produccion/pdf', [ProduccionController::class, 'exportPdf'])->name('produccion.pdf');
    Route::resource('produccion', ProduccionController::class);
    Route::resource('alimentacion', AlimentacionController::class);
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
});

// Rutas exclusivas para administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('gastos', GastoController::class);
    Route::resource('ventas', VentaController::class);
    Route::get('usuarios', [UserController::class, 'index'])->name('usuarios.index');
});

require __DIR__.'/auth.php';
