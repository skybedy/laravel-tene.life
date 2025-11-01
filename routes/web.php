<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\WeatherController;



Route::get('/', [IndexController::class, 'index'])->name('index.index');
Route::get('/webcam/big', [IndexController::class, 'webcamBig'])->name('index.webcam.big');

// API endpoint for weather data
Route::get('/api/weather/hourly', [WeatherController::class, 'getHourlyData'])->name('api.weather.hourly');
