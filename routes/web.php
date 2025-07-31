<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\AdminTestimoniController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
});

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::resource('laporan', LaporanController::class)->middleware('auth');

// Testimoni Routes
Route::middleware(['auth'])->group(function () {
    Route::get('testimoni/create', [TestimoniController::class, 'create'])->name('testimoni.create');
    Route::post('testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export', [AdminLaporanController::class, 'export'])->name('laporan.export');
    Route::get('laporan/{laporan}', [AdminLaporanController::class, 'show'])->name('laporan.show');
    Route::put('laporan/{laporan}/status', [AdminLaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::post('laporan/{laporan}/tanggapan', [AdminLaporanController::class, 'tanggapan'])->name('laporan.tanggapan');
    Route::resource('testimoni', AdminTestimoniController::class)->except(['create', 'store', 'show', 'edit']);
});