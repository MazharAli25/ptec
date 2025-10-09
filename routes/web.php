<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('super-admin')
    ->middleware(['web', 'auth:super_admin'])
    ->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
        Route::resource('/institute', InstituteController::class);
        Route::resource('/session', SessionController::class);
        Route::resource('/course', CourseController::class);
    });


Route::middleware(['web', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        Route::resource('/admin', AdminController::class)->names([
            'index' => 'admin.index',
            'create' => 'admin.create',
            'store' => 'admin.store',
            'edit' => 'admin.edit',
            'update' => 'admin.update',
            'destroy' => 'admin.destroy',
            'show' => 'admin.show',
        ]);
    });



require __DIR__ . '/auth.php';
// $2y$12$MGUKRihIe1HCL1CKvl6da.QsRA7Hd/J9W540JOHYl8SEN5nUUqzh.