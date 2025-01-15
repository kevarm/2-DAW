<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;


Route::get('/about',[HomeController::class,'about'])->name('about');

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/product', [ProductController::class,'index'])->name('product');

