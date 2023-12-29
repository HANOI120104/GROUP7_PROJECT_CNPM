<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
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

Route::get('/admin-login', [AdminController::class, 'showAdminLogin'])->name('show.admin.login');
Route::post('/admin-login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin-logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('admin.auth')->name('dashboard');

Route::get('/admin/user', [AdminController::class, 'showUser'])->middleware('admin.auth')->name('show.user');
Route::get('/admin/add-user', [AdminController::class, 'showAddUser'])->middleware('admin.auth')->name('show.add.user');
Route::post('/admin/add-user', [AdminController::class, 'addUser'])->middleware('admin.auth')->name('add.user');
Route::delete('/deleteuser/{id}', [AdminController::class, 'deleteUser'])->middleware('admin.auth')->name('delete.user');
Route::get('/edit-user/{id}',[AdminController::class, 'editUser'])->middleware('admin.auth')->name('edit.user');
Route::patch('/update-user/{id}',[AdminController::class, 'updateUser'])->middleware('admin.auth')->name('update.user');


Route::get('/admin/product', [AdminController::class, 'showProduct'])->middleware('admin.auth')->name('show.product');
Route::get('/admin/admin-product', [AdminController::class, 'showAdminProduct'])->middleware('admin.auth')->name('show.admin.product');
Route::get('/admin/add-product', [AdminController::class, 'showAddProduct'])->middleware('admin.auth')->name('show.add.product');
Route::post('/get-brands', [AdminController::class, 'getBrands']);
Route::post('/admin/add-product',[AdminController::class, 'addProduct'])->middleware('admin.auth')->name('add.product');
Route::get('/admin/product-detail/{id}', [AdminController::class, 'productDetail'])->middleware('admin.auth')->name('product.detail');
Route::get('/edit-product/{id}',[AdminController::class, 'editProduct'])->middleware('admin.auth')->name('edit.product');
Route::patch('/update-product/{id}',[AdminController::class, 'updateProduct'])->middleware('admin.auth')->name('update.product');
Route::delete('/deleteprodct/{id}', [AdminController::class, 'deleteProduct'])->middleware('admin.auth')->name('delete.product');
Route::post('/admin/add-size', [AdminController::class, 'addSize'])->middleware('admin.auth')->name('add.size');
Route::patch('update-size/{id}',[AdminController::class, 'updateSize'])->middleware('admin.auth')->name('update.size');
Route::delete('/deletesize/{id}', [AdminController::class, 'deleteSize'])->middleware('admin.auth')->name('delete.size');
Route::post('/admin/add-image', [AdminController::class, 'addImage'])->middleware('admin.auth')->name('add.image');
Route::patch('update-image/{id}',[AdminController::class, 'updateImage'])->middleware('admin.auth')->name('update.image');
Route::delete('/deleteimage/{id}', [AdminController::class, 'deleteImage'])->middleware('admin.auth')->name('delete.image');
Route::patch('/admin/approve-product/{id}', [AdminController::class, 'approveProduct'])->middleware('admin.auth')->name('approve.product');


Route::get('/admin/brand', [AdminController::class, 'showBrand'])->middleware('admin.auth')->name('show.brand');
Route::get('/admin/admin-brand', [AdminController::class, 'showAdminBrand'])->middleware('admin.auth')->name('show.admin.brand');
Route::post('/admin/add-brand',[AdminController::class, 'addBrand'])->middleware('admin.auth')->name('add.brand');
Route::delete('/deletebrand/{id}', [AdminController::class, 'deleteBrand'])->middleware('admin.auth')->name('delete.brand');
Route::get('/edit-brand/{id}',[AdminController::class, 'editBrand'])->middleware('admin.auth')->name('edit.brand');
Route::patch('update-brand/{id}',[AdminController::class, 'updateBrand'])->middleware('admin.auth')->name('update.brand');
Route::patch('/admin/approve-brand/{id}', [AdminController::class, 'approveBrand'])->middleware('admin.auth')->name('approve.brand');




Route::get('/admin/order', [AdminController::class, 'showOrder'])->middleware('admin.auth')->name('show.order');
Route::get('/admin/order-detail/{id}', [AdminController::class, 'showOrderDetail'])->middleware('admin.auth')->name('show.order.detail');
Route::patch('/admin/approve-order/{id}', [AdminController::class, 'approveOrder'])->middleware('admin.auth')->name('approve.order');
Route::delete('/deleteorder/{id}', [AdminController::class, 'deleteOrder'])->middleware('admin.auth')->name('delete.order');





Route::get('/admin/customer', [AdminController::class, 'showCustomer'])->middleware('admin.auth')->name('show.customer');
Route::get('/admin/edit-customer/{id}', [AdminController::class, 'editCustomer'])->middleware('admin.auth')->name('edit.customer');
Route::patch('/update-customer/{id}',[AdminController::class, 'updateCustomer'])->middleware('admin.auth')->name('update.customer');
Route::delete('/deletecustomer/{id}', [AdminController::class, 'deleteCustomer'])->middleware('admin.auth')->name('delete.customer');