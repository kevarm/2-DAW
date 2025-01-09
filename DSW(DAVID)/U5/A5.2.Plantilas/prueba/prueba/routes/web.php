<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*Route::get('/', function () {
    $title='Título';
    return view('/home/index', compact('title'));
})->name('home');*/

Route::get('/about',[HomeController::class,'about'])->name('about');

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/product', [ProductController::class,'index'])->name('product');