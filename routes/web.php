<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\QrCodeController;
use App\Http\Controllers\admin\ShopCategory;
use App\Http\Controllers\admin\ShopKeeper;

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

Route::prefix('admin')->middleware('admin.access')->group(function () {
    //admin login
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::resource('users', UserController::class);
    Route::post('user-data', [UserController::class, 'data'])->name('admin.users.data');
    Route::resource('qr-code', QrCodeController::class);
    Route::post('qr-list', [QrCodeController::class, 'qr_list'])->name('admin.qr-list');
    Route::resource('shop', ShopKeeper::class);
    Route::post('shop-list', [ShopKeeper::class, 'shop_list'])->name('admin.shop.data');
    Route::resource('category', ShopCategory::class);
    Route::post('category-list', [ShopCategory::class, 'category_list'])->name('admin.category-list');
});

Route::redirect('/admin', '/admin/login');
Route::get('admin/login', [AuthController::class, 'index'])->name('admin.login');
Route::post('admin/login/post', [AuthController::class, 'login'])->name('admin.login.post');
