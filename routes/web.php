<?php

use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\KategoriController;
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
use App\Models\PemindahanInventaris;
use App\Models\QRCodeInventaris;

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

// Profile Management

Route::get('/profile', [ProfileController::class, 'profile'])
    ->middleware(['auth']);

Route::post('/profile/change-role', [ProfileController::class, 'updateRole'])
    ->middleware(['auth'])->name('profile.change-role');

Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])
    ->middleware(['auth'])->name('profile.change-password');

// Profile Management

// User Management

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

Route::get('/user-management/reset-password/{user:slug}', [UserController::class, 'resetUserPassword'])
    ->middleware(['auth', CheckPermission::class . ':edit-user']);

Route::delete('/user-management/delete/{user:slug}', [UserController::class, 'deleteUser'])
    ->middleware(['auth', CheckPermission::class . ':delete-user']);

// User Management

// Role Management

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

// Role Management

// Kantor Management

Route::get('/kantor-management', [KantorController::class, 'showKantor'])
    ->middleware(['auth', CheckPermission::class . ':view-kantor']);

Route::get('/kantor-management/kantor/{kantor:slug}', [KantorController::class, 'showKantorDetails'])
    ->middleware(['auth', CheckPermission::class . ':view-kantor']);

Route::get('/kantor-management/ruangan/{ruangan:ruangan_id}', [KantorController::class, 'showRuanganDetails'])
    ->middleware(['auth', CheckPermission::class . ':view-kantor']);

Route::get('/kantor-management/add', [KantorController::class, 'showAddKantor'])
    ->middleware(['auth', CheckPermission::class . ':add-kantor']);

Route::post('/kantor-management/add', [KantorController::class, 'addKantor'])
    ->middleware(['auth', CheckPermission::class . ':add-kantor']);
    
Route::get('/kantor-management/edit/{kantor:slug}', [KantorController::class, 'showEditKantor'])
    ->middleware(['auth', CheckPermission::class . ':edit-kantor']);
    
Route::post('/kantor-management/edit/{kantor:slug}', [KantorController::class, 'editKantor'])
    ->middleware(['auth', CheckPermission::class . ':edit-kantor']);

Route::delete('/kantor-management/delete/{kantor:slug}', [KantorController::class, 'deleteKantor'])
    ->middleware(['auth', CheckPermission::class . ':delete-kantor']);

Route::get('/kantor-management/api/lantai/kantor/{id}', [KantorController::class, 'getLantaiByKantor']);

Route::get('/kantor-management/api/ruangan/lantai/{id}', [KantorController::class, 'getRuanganByLantai']);

Route::get('/kantor-management/api/kabupaten/provinsi/{id}', [KantorController::class, 'getKabupatenByProvinsi']);

// Kantor Management

// Inventaris Management

Route::get('/inventaris-management', [InventarisController::class, 'showInventaris'])
    ->middleware(['auth', CheckPermission::class . ':view-inventaris']);

Route::get('/inventaris-management/inventaris/{inventaris:inventaris_id}', [InventarisController::class, 'showInventarisDetails'])
    ->middleware(['auth', CheckPermission::class . ':view-inventaris']);

Route::get('/inventaris-management/add', [InventarisController::class, 'showAddInventaris'])
    ->middleware(['auth', CheckPermission::class . ':input-inventaris']);
    
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

Route::get('/inventaris-management/pemindahan', [InventarisController::class, 'showAddPemindahanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':add-pemindahan-inventaris']);

Route::post('/inventaris-management/pemindahan', [InventarisController::class, 'addPemindahanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':add-pemindahan-inventaris']);

Route::get('/approval-pemindahan-inventaris', [InventarisController::class, 'showPemindahanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':view-approval-pemindahan-inventaris']);

Route::get('/approval-pemindahan-inventaris/{pemindahanInventaris:pemindahan_inventaris_id}', [InventarisController::class, 'showPemindahanInventarisDetails'])
    ->middleware(['auth', CheckPermission::class . ':view-approval-pemindahan-inventaris']);

Route::post('/approval-pemindahan-inventaris/{pemindahanInventaris:pemindahan_inventaris_id}/approve', [InventarisController::class, 'approvePemindahanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':approval-pemindahan-inventaris-1,approval-pemindahan-inventaris-2']);

Route::post('/approval-pemindahan-inventaris/{pemindahanInventaris:pemindahan_inventaris_id}/reject', [InventarisController::class, 'rejectPemindahanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':approval-pemindahan-inventaris-1,approval-pemindahan-inventaris-2']);

Route::get('/inventaris-management/download/{filename}', [InventarisController::class, 'downloadQrCodeInventaris'])
    ->middleware(['auth', CheckPermission::class . ':view-inventaris']);
    
Route::get('/inventaris-management/kondisi/{inventaris:inventaris_id}', [InventarisController::class, 'showEditKondisiInventaris'])
    ->middleware(['auth', CheckPermission::class . ':ubah-kondisi-inventaris']);
    
Route::post('/inventaris-management/kondisi/{inventaris:inventaris_id}', [InventarisController::class, 'editKondisiInventaris'])
    ->middleware(['auth', CheckPermission::class . ':ubah-kondisi-inventaris']);
    
// Inventaris Management

// Laporan Inventaris

Route::get('/laporan-inventaris', [InventarisController::class, 'inputLaporanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':laporan-inventaris']);

Route::get('/laporan-inventaris/result', [InventarisController::class, 'laporanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':laporan-inventaris']);

Route::get('/laporan-inventaris/download', [InventarisController::class, 'downloadLaporanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':laporan-inventaris']);

// Laporan Inventaris

// Laporan Pemindahan Inventaris

Route::get('/laporan-pemindahan-inventaris', [InventarisController::class, 'inputLaporanPemindahanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':laporan-pemindahan-inventaris']);

Route::get('/laporan-pemindahan-inventaris/result', [InventarisController::class, 'laporanPemindahanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':laporan-pemindahan-inventaris']);

Route::get('/laporan-pemindahan-inventaris/download', [InventarisController::class, 'downloadLaporanPemindahanInventaris'])
    ->middleware(['auth', CheckPermission::class . ':laporan-pemindahan-inventaris']);

// Laporan Pemindahan Inventaris

// Kategori Management

Route::get('/kategori-management', [KategoriController::class, 'showKategori'])
    ->middleware(['auth', CheckPermission::class . ':view-kategori']);

Route::get('/kategori-management/add', [KategoriController::class, 'showAddKategori'])
    ->middleware(['auth', CheckPermission::class . ':add-kategori']);

Route::post('/kategori-management/add', [KategoriController::class, 'addKategori'])
    ->middleware(['auth', CheckPermission::class . ':add-kategori']);

Route::get('/kategori-management/edit/{kategori:slug}', [KategoriController::class, 'showEditKategori'])
    ->middleware(['auth', CheckPermission::class . ':edit-kategori']);

Route::post('/kategori-management/edit/{kategori:slug}', [KategoriController::class, 'editKategori'])
    ->middleware(['auth', CheckPermission::class . ':edit-kategori']);

Route::delete('/kategori-management/delete/{kategori:slug}', [KategoriController::class, 'deleteKategori'])
    ->middleware(['auth', CheckPermission::class . ':delete-kategori']);

// Kategori Management

// Forget reset password

Route::get('/forget-password', [ProfileController::class, 'showForgotPasswordForm']);

Route::post('/forget-password', [ProfileController::class, 'forgotPassword']);

Route::get('/reset-password', [ProfileController::class, 'showResetPasswordForm']);

Route::post('/reset-password', [ProfileController::class, 'resetPassword']);

// Forget reset password

require __DIR__.'/auth.php';
