<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/work', [PortfolioController::class, 'work'])->name('work');
Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/resume', [PortfolioController::class, 'resume'])->name('resume');
