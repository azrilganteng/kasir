<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\KasirLoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kasir/dashboard', function () {
    return view('kasir.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function () {   
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/kasir/dashboard', [DashboardController::class, 'index'])->name('kasir.dashboard');

Route::get('/admin/produk/create', [ProductController::class, 'create']);
Route::post('/admin/produk/store', [ProductController::class, 'store']);
Route::get('/admin/produk/{product}/edit', [ProductController::class, 'edit']);
Route::put('/admin/produk/{product}', [ProductController::class, 'update']);
Route::delete('/admin/produk/{product}', [ProductController::class, 'destroy']);    

Route::get('/admin/kasir/createkasir',[UserController::class,'tambahkasir']);
Route::get('/admin/kasir/semuauser',[UserController::class,'alluser'])->name('admin.kasir.semuauser');
Route::get('/admin/kasir/createkasir', [UserController::class, 'create']);
Route::post('/admin/kasir/storekasir', [UserController::class, 'store']);
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/kasir/login', [KasirLoginController::class, 'showLoginForm'])->name('kasir.login');
Route::post('/kasir/login', [KasirLoginController::class, 'login']);
Route::post('/kasir/logout', [KasirLoginController::class, 'logout'])->name('kasir.logout');

Route::middleware(['cek.level:1'])->group(function () {
    // Rute yang hanya bisa diakses oleh pengguna dengan level 'admin'
});
Route::middleware(['cek.level:2'])->group(function () {
    
});

});

Route::post('/products/{id}/update-stock', [ProductController::class, 'updateStock']);
Route::post('/kasir/add/{id}', [KasirController::class, 'addToTransaction'])->name('kasir.add');
Route::delete('/kasir/remove/{id}', [KasirController::class, 'removeFromTransaction'])->name('kasir.remove');
Route::post('/kasir/checkout', [KasirController::class, 'store'])->name('checkout');
Route::get('kasir/nota/{transaction}', [KasirController::class, 'nota'])->name('checkout.nota');

Route::get('/kasir/rekap', [TransactionController::class, 'rekap'])->name('kasir.rekap');


require __DIR__.'/auth.php';