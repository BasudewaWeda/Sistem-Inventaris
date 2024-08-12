<?php

use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KantorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Inventaris;
use App\Models\User;
use App\Models\Role;
use App\Models\Kantor;
use App\Models\InputInventaris;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/profile', [ProfileController::class, 'profile'])
    ->middleware(['auth']);

Route::post('/profile/change-role', [ProfileController::class, 'updateRole'])
    ->middleware(['auth'])->name('profile.change-role');

Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])
    ->middleware(['auth'])->name('profile.change-password');

Route::get('/user-management', [UserController::class, 'showUser'])
    ->middleware(['auth', CheckPermission::class . ':view-user']);

Route::get('/user-management/add', [UserController::class, 'showAddUser'])
    ->middleware(['auth', CheckPermission::class . ':add-user']);

Route::post('/user-management/add', [UserController::class, 'addUser'])
    ->middleware(['auth', CheckPermission::class . ':add-user']);

Route::get('/user-management/edit/{user:slug}', [UserController::class, 'showEditUser'])
    ->middleware(['auth', CheckPermission::class . ':edit-user']);

Route::post('/user-management/edit/{user:slug}', [UserController::class, 'editUser'])
    ->middleware(['auth', CheckPermission::class . ':edit-user']);

Route::delete('/user-management/delete/{user:slug}', [UserController::class, 'deleteUser'])
    ->middleware(['auth', CheckPermission::class . ':delete-user']);

Route::get('/role-management', [RoleController::class, 'showRole'])
    ->middleware(['auth', CheckPermission::class . ':view-role']);

Route::get('/role-management/add', [RoleController::class, 'showAddRole'])
    ->middleware(['auth', CheckPermission::class . ':add-role']);

Route::post('/role-management/add', [RoleController::class, 'addRole'])
    ->middleware(['auth', CheckPermission::class . ':add-role']);

Route::get('/role-management/edit/{role:slug}', [RoleController::class, 'showEditRole'])
    ->middleware(['auth', CheckPermission::class . ':edit-role']);

Route::post('/role-management/edit/{role:slug}', [RoleController::class, 'editRole'])
    ->middleware(['auth', CheckPermission::class . ':edit-role']);
    
Route::delete('/role-management/delete/{role:slug}', [RoleController::class, 'deleteRole'])
->middleware(['auth', CheckPermission::class . ':delete-role']);

Route::get('/kantor-management', [KantorController::class, 'showKantor'])
    ->middleware(['auth', CheckPermission::class . ':view-kantor']);

Route::get('/kantor-management/kantor/{kantor:slug}', [KantorController::class, 'showKantorDetails'])
    ->middleware(['auth', CheckPermission::class . ':view-kantor']);

Route::get('/inventaris-management', [InventarisController::class, 'showInventaris'])
    ->middleware(['auth', CheckPermission::class . ':view-inventaris']);

Route::get('/inventaris-management/inventaris/{inventaris:inventaris_id}', [InventarisController::class, 'showInventarisDetails'])
    ->middleware(['auth', CheckPermission::class . ':view-inventaris']);

Route::get('/inventaris-management/add', [InventarisController::class, 'showAddInventaris'])
    ->middleware(['auth', CheckPermission::class . ':input-inventaris']);
    
// Getting data for adding inventaris
Route::get('/inventaris-management/lantai/kantor/{id}', [InventarisController::class, 'getLantaiByKantor']);

Route::get('/inventaris-management/ruangan/lantai/{id}', [InventarisController::class, 'getRuanganByLantai']);

Route::post('/inventaris-management/add', [InventarisController::class, 'addInventaris'])
    ->middleware(['auth', CheckPermission::class . ':input-inventaris']);

Route::get('/approval-inventaris', [InventarisController::class, 'showInputInventaris'])
    ->middleware(['auth', CheckPermission::class . ':view-approval-inventaris']);

Route::get('/approval-inventaris/{inputInventaris:input_inventaris_id}', [InventarisController::class, 'showInputInventarisDetails'])
    ->middleware(['auth', CheckPermission::class . ':view-approval-inventaris']);

Route::post('/approval-inventaris/{inputInventaris:input_inventaris_id}/approve', [InventarisController::class, 'approveInputInventaris'])
    ->middleware(['auth', CheckPermission::class . ':approval-inventaris-1,approval-inventaris-2']);

Route::post('/approval-inventaris/{inputInventaris:input_inventaris_id}/reject', [InventarisController::class, 'rejectInputInventaris'])
    ->middleware(['auth', CheckPermission::class . ':approval-inventaris-1,approval-inventaris-2']);

require __DIR__.'/auth.php';
