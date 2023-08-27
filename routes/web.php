<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/mantap', function () {
    return view('coba');
});


Route::get('/home', [App\Http\Controllers\FrontendController::class, 'index']);
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\LoginController::class, 'register']);
Route::post('/register/proses', [App\Http\Controllers\LoginController::class, 'registerproses']);
Route::get('/get_kotaa/{id}', [App\Http\Controllers\LoginController::class, 'getKotaa']);

// Route::resource('/home/{id}', App\Http\Controllers\ProductViewController::class);
Route::get('order_proses/{id}', [App\Http\Controllers\OrderController::class, 'index']);
Route::post('order/{id}', [App\Http\Controllers\OrderController::class, 'order'])->name('order')->middleware('auth');
Route::get('/cart', [App\Http\Controllers\OrderController::class, 'cart'])->middleware('auth');
Route::delete('/cart/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('destroy');


Route::get('/checkout/{id}', [App\Http\Controllers\CheckoutController::class, 'index'])->middleware('auth');
Route::get('/get_kota/{id}', [App\Http\Controllers\CheckoutController::class, 'getKota'])->middleware('auth');
Route::get('/get_ongkir/{destination}/{weight}', [App\Http\Controllers\CheckoutController::class, 'getOngkir'])->middleware('auth');

Route::post('/pembayaran-proses/{id}', [App\Http\Controllers\TransactionController::class, 'index'])->middleware('auth');
Route::get('/pembayaran/{id}', [App\Http\Controllers\TransactionController::class, 'pembayaran'])->middleware('auth');

Route::post('/pembayaran-selesai/{id}', [App\Http\Controllers\TransactionController::class, 'pembayaranProses'])->middleware('auth');
Route::get('/checkout-selesai/{id}', [App\Http\Controllers\TransactionController::class, 'pembayaranSelesai'])->middleware('auth');

Route::get('/pesanan-saya', [App\Http\Controllers\PesananController::class, 'index'])->middleware('auth');
Route::get('/profil-saya', [App\Http\Controllers\UserController::class, 'showProfile'])->middleware('auth');
Route::get('/get_kotaaa/{id}', [App\Http\Controllers\UserController::class, 'getKotaaa']);
Route::post('/edit-user/{id}', [App\Http\Controllers\UserController::class, 'editUser']);

Route::get('pesanan-saya/review/{order_id}', [App\Http\Controllers\ReviewController::class, 'index'])->name('pesanan-saya.review');
Route::post('/review/store', [App\Http\Controllers\ReviewController::class, 'store']);


// Route::get('/checkout/{id}', [App\Http\Controllers\CheckoutController::class, 'getProvinsi'])->middleware('auth');

// Route::post('order/{id}', App\Http\Controllers\OrderController::class, 'order');


Route::middleware(['role:Administrator,Admin', 'auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::resource('/products', App\Http\Controllers\ProductController::class);
    Route::resource('/categories', App\Http\Controllers\CategoriesController::class);
    Route::resource('/banners', App\Http\Controllers\BannerController::class);
    Route::get('/kelola-user', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('user/tambah-admin', [App\Http\Controllers\UserController::class, 'register_admin']);
    Route::post('/tambah-admin/proses', [App\Http\Controllers\UserController::class, 'registerProses']);
    Route::get('/konfirmasi-pembayaran', [App\Http\Controllers\backend\PesananController::class, 'index']);
    Route::get('/konfirmasi-pembayaran/detail/{id}', [App\Http\Controllers\backend\PesananController::class, 'detailKonfirmasi']);
    Route::get('/pesanan-dikirim/detail/{id}', [App\Http\Controllers\backend\PesananController::class, 'detailDikirim']);
    Route::post('/konfirmasi/{id}', [App\Http\Controllers\backend\PesananController::class, 'konfirmasiProses']);
    Route::get('/pesanan-dikirim', [App\Http\Controllers\backend\PesananController::class, 'pesananDikirim']);
    Route::get('/pesanan-diterima', [App\Http\Controllers\backend\PesananController::class, 'pesananDiterima']);

    Route::delete('/user/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete');
});
