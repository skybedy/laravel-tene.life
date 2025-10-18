<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;



Route::get('/', [IndexController::class, 'index'])->name('index.index');
Route::get('/webcam/big', [IndexController::class, 'webcamBig'])->name('index.webcam.big');
