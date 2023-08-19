<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rotas para Vendas
Route::get('vendas', [VendaController::class, 'index'])->name('index');
Route::get('vendas/create', [VendaController::class, 'create'])->name('create');
Route::post('vendas', [VendaController::class, 'store'])->name('store');
Route::get('vendas/{venda}', [VendaController::class, 'show'])->name('show');
Route::get('vendas/{venda}/edit', [VendaController::class, 'edit'])->name('edit');
Route::put('vendas/{venda}', [VendaController::class, 'update'])->name('update');
Route::delete('vendas/{venda}', [VendaController::class, 'destroy'])->name('destroy');
