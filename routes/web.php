<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\prodiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('prodi', prodiController::class);
Route::resource('mahasiswa', mahasiswaController::class);
Route::resource('dosen', DosenController::class);
Route::resource('mata-kuliah', MataKuliahController::class);
