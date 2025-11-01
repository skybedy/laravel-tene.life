<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\WeatherController;

// API endpoint for weather data (no locale prefix)
Route::get('/api/weather/hourly', [WeatherController::class, 'getHourlyData'])->name('api.weather.hourly');

// Routes with optional locale prefix
Route::group(['prefix' => '{locale?}', 'where' => ['locale' => 'cs|en|es|de|it|pl|hu']], function () {
    Route::get('/', [IndexController::class, 'index'])->name('index.index');
    Route::get('/webcam/big', [IndexController::class, 'webcamBig'])->name('index.webcam.big');
});
