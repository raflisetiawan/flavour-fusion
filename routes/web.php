<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\ManageKedaiController;
use App\Http\Controllers\admin\ManagePengajuanPemilikKedai;
use App\Http\Controllers\admin\ManagePengajuanPemilikKedaiController;
use App\Http\Controllers\admin\ManageUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\kedai\ManageMenuController;
use App\Http\Controllers\KedaiController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ManageMenuController as AdminManageMenuController;
use App\Http\Controllers\admin\ManageOrderController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');;

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');;
Route::post('register', [AuthController::class, 'register'])->middleware('guest');

Route::get('/kedai/{kedai}', [KedaiController::class, 'show'])->name('kedai.show');




Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
    Route::get('mendaftar/pemilik-kedai', [KedaiController::class, 'halamanDaftarSebagaiPemilikKedai'])->name('halamanDaftarSebagaiPemilikKedai');
    Route::post('mendaftar/pemilik-kedai', [KedaiController::class, 'daftarSebagaiPemilikKedai'])->name('daftarSebagaiPemilikKedai');

    Route::get('/order/{menu}', [OrderController::class, 'create'])->name('order.create');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [ManageUserController::class, 'index'])->name('admin.user.index');

    Route::delete('/admin/users/{id}', [ManageUserController::class, 'destroy'])->name('admin.user.destroy');
    Route::post('/admin/users/{id}/role', [ManageUserController::class, 'updateRole'])->name('admin.user.updateRole');

    Route::get('/manage-pengajuan-pemilik-kedai', [ManagePengajuanPemilikKedaiController::class, 'index'])->name('admin.manage-pengajuan-pemilik-kedai.index');
    Route::patch('/manage-pengajuan-pemilik-kedai/approve/{id}', [ManagePengajuanPemilikKedaiController::class, 'approve'])->name('admin.manage-pengajuan-pemilik-kedai.approve');
    Route::patch('/manage-pengajuan-pemilik-kedai/reject/{id}', [ManagePengajuanPemilikKedaiController::class, 'reject'])->name('admin.manage-pengajuan-pemilik-kedai.reject');

    Route::get('/kedai', [ManageKedaiController::class, 'index'])->name('admin.kedai.index');
    Route::get('/kedai/{id}/edit', [ManageKedaiController::class, 'edit'])->name('admin.kedai.edit');
    Route::patch('/kedai/{id}', [ManageKedaiController::class, 'update'])->name('admin.kedai.update');
    Route::delete('/kedai/{id}', [ManageKedaiController::class, 'destroy'])->name('admin.kedai.destroy');


    Route::get('admin/menus', [AdminManageMenuController::class, 'index'])->name('admin.manage-menus.index');
    Route::get('admin/menus/create', [AdminManageMenuController::class, 'create'])->name('admin.manage-menus.create');
    Route::post('admin/menus', [AdminManageMenuController::class, 'store'])->name('admin.manage-menus.store');
    Route::get('admin/menus/{menu}/edit', [AdminManageMenuController::class, 'edit'])->name('admin.manage-menus.edit');
    Route::put('admin/menus/{menu}', [AdminManageMenuController::class, 'update'])->name('admin.manage-menus.update');
    Route::delete('admin/menus/{menu}', [AdminManageMenuController::class, 'destroy'])->name('admin.manage-menus.destroy');

    Route::get('admin/orders', [ManageOrderController::class, 'index'])->name('admin.manage-orders.index');
    Route::get('admin/orders/{order}/edit', [ManageOrderController::class, 'edit'])->name('admin.manage-orders.edit');
    Route::put('admin/orders/{order}', [ManageOrderController::class, 'update'])->name('admin.manage-orders.update');
    Route::delete('admin/orders/{order}', [ManageOrderController::class, 'destroy'])->name('admin.manage-orders.destroy');


});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

    Route::get('/order/{orderId}/payment', [OrderController::class, 'payment'])->name('order.payment');
    Route::post('/order/{orderId}/process-payment', [OrderController::class, 'processPayment'])->name('order.processPayment');
});



Route::prefix('pemilik-kedai')->middleware(['auth', 'role:pemilik_kedai'])->group(function () {

    Route::get('/', [KedaiController::class, 'index'])->name('pemilikKedaiIndex');

    Route::get('/menu', [ManageMenuController::class, 'index'])->name('pemilikKedai.menu.index');
    Route::get('/menu/create', [ManageMenuController::class, 'create'])->name('pemilikKedai.menu.create');
    Route::post('/menu', [ManageMenuController::class, 'store'])->name('pemilikKedai.menu.store');
    Route::get('/menu/{id}/edit', [ManageMenuController::class, 'edit'])->name('pemilikKedai.menu.edit');
    Route::put('/menu/{id}', [ManageMenuController::class, 'update'])->name('pemilikKedai.menu.update');
    Route::delete('/menu/{id}', [ManageMenuController::class, 'destroy'])->name('pemilikKedai.menu.destroy');

    Route::get('/menu/{menuId}/orders', [ManageMenuController::class, 'showOrderDetails'])->name('pemilikKedai.menu.showOrderDetails');

});
