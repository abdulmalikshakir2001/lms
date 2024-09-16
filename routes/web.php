<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('html.index');
    })->name('dashboard');

    // Roles
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles-data', [RoleController::class, 'getData'])->name('roles.getData');
    Route::post('roles/bulk-delete', [RoleController::class, 'bulkDelete'])->name('roles.bulkDelete');
    
    // Permissions
    Route::get('/permissions/create', [PermissionsController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionsController::class, 'store'])->name('permissions.store');
    Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/{id}/edit', [PermissionsController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{id}', [PermissionsController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/permissions-data', [PermissionsController::class, 'getData'])->name('permissions.getData');

    // Users
    Route::get('users',[UserController::class, 'index'])->name('users.index');
    Route::get('users/create',[UserController::class, 'create'])->name('users.create');
    Route::post('users/store',[UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('users-data', [UserController::class, 'getUsersData'])->name('users.data');
    Route::post('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');



});


// Include the authentication routes
require __DIR__.'/auth.php';