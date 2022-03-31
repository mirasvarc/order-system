<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home')->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('orders')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('orders.index');
    });
});

Route::prefix('clients')->middleware(['auth'])->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/add', [ClientController::class, 'create']);
    Route::post('/add', [ClientController::class, 'store']);
    Route::get('/list', [ClientController::class, 'getClients'])->name('clients.list');
    Route::get('/{id}', [ClientController::class, 'show']);
});

Route::prefix('orders')->middleware(['auth'])->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/add', [OrderController::class, 'create']);
    Route::post('/add', [OrderController::class, 'store']);
    Route::get('/list', [OrderController::class, 'getOrders'])->name('orders.list');
    Route::get('/client-orders-list', [OrderController::class, 'getClientOrders'])->name('client_orders.list');
    Route::get('/{id}', [OrderController::class, 'show']);
});

require __DIR__.'/auth.php';
