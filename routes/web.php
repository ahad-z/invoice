<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
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
    return view('invoice');
});
Route::get('/pdf', function () {
    return view('invoicePrint');
});

Route::get('generate-pdf/{id}', [OrdersController::class, 'generatePDF'])->name('generate-pdf');


Route::get('orders', [OrdersController::class, 'index'])->name('index');
Route::post('orders-store', [OrdersController::class, 'store'])->name('orderStore');
