<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

// Publicly accessible routes (for guests)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Common user routes (requires authentication)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [AuthenticatedSessionController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Admin-specific routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index'); // List users
        Route::get('/create', [AdminUserController::class, 'create'])->name('create'); // Show create form
        Route::post('/', [AdminUserController::class, 'store'])->name('store'); // Store new user
        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit'); // Show edit form
        Route::put('/{user}', [AdminUserController::class, 'update'])->name('update'); // Update user
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy'); // Delete user
    });
});


// Include other auth routes if any
require __DIR__ . '/auth.php';
