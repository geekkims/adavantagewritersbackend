<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserTypeAdmin;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin')->middleware(['auth', UserTypeAdmin::class])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/fetch-users', [UserController::class, 'test']);
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', UserTypeAdmin::class])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
