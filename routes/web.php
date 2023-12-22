<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
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
Route::get('/customer-login', [ClientController::class, 'showCustomerLogin'])->name('show.customer.login');
Route::post('/customer-login', [ClientController::class, 'CustomerLogin'])->name('customer.login');
Route::post('/customer-logout', [ClientController::class, 'CustomerLogout'])->name('customer.logout');
Route::get('/customer-info', [ClientController::class, 'CustomerInfo'])->middleware('customer.auth')->name('customer.info');
Route::get('/change-info/{id}', [ClientController::class, 'editCustomer'])->middleware('customer.auth')->name('client.edit.customer');
Route::patch('/change-info/{id}',[ClientController::class, 'updateCustomer'])->middleware('customer.auth')->name('client.update.customer');
Route::get('/customer-register', [ClientController::class, 'showCustomerRegister'])->name('show.customer.register');
Route::post('/customer-register', [ClientController::class, 'CustomerRegister'])->name('customer.register');
Route::get('/contact', [ClientController::class, 'contact'])->name('contact');
Route::get('/statc', [ClientController::class, 'static'])->name('static');