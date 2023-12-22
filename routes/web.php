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



Route::get('/', [ClientController::class, 'HomePage'])->name('homepage');
Route::get('/category', [ClientController::class, 'Category'])->name('category');
Route::get('/filter-products', [ClientController::class, 'filterProducts'])->name('filter.products');
Route::get('/product-detail',[ClientController::class, 'detailProduct'])->name('detail.product');
Route::get('/search', [ClientController::class, 'search'])->name('product.search.result');
Route::post('/search', [ClientController::class, 'search'])->name('product.search');

Route::get('/cart', [ClientController::class, 'showCart'])->name('show.cart');
Route::post('/remove-cart/{id}', [ClientController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/change-quantity', [ClientController::class, 'changeQuantity'])->name('change.quantity');
Route::delete('/clientdeleteorder/{id}', [ClientController::class, 'deleteOrder'])->name('client.delete.order');


Route::get('/thanhtoan', [ClientController::class, 'showThanhtoan'])->middleware('customer.auth')->name('show.thanhtoan');
Route::post('/thanhtoan', [ClientController::class, 'thanhtoan'])->name('thanhtoan');

Route::post('/add-to-cart', [ClientController::class, 'addToCart'])->name('add.to.cart');
Route::post('/buynow', [ClientController::class, 'buynow'])->name('buy.now');