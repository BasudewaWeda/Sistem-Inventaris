<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user-management', [UserController::class, 'showUser'])
    ->middleware(['auth', CheckPermission::class . ':user']);

Route::get('/user-management/add', [UserController::class, 'showAddUser'])
    ->middleware(['auth', CheckPermission::class . ':add-user']);

Route::post('/user-management/add', [UserController::class, 'addUser'])
    ->middleware(['auth', CheckPermission::class . ':add-user']);

require __DIR__.'/auth.php';
