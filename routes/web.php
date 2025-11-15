<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CameraUploadController;

// API endpoints for weather data (no locale prefix)
Route::get('/api/weather/hourly', [WeatherController::class, 'getHourlyData'])->name('api.weather.hourly');
Route::get('/api/weather/daily', [WeatherController::class, 'getDailyData'])->name('api.weather.daily');
Route::get('/api/weather/monthly-daily', [WeatherController::class, 'getMonthlyDailyData'])->name('api.weather.monthly-daily');
Route::get('/api/weather/sea-temperature', [WeatherController::class, 'getSeaTemperature'])->name('api.weather.sea-temperature.get');
Route::post('/api/weather/sea-temperature', [WeatherController::class, 'storeSeaTemperature'])->name('api.weather.sea-temperature.store');

// Routes with locale prefix
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'cs|en|es|de|it|pl|hu|fr']], function () {
    Route::get('/', [IndexController::class, 'index'])->name('index.index.locale');
    Route::get('/webcam/big', [IndexController::class, 'webcamBig'])->name('index.webcam.big.locale');
    Route::get('/statistics', [IndexController::class, 'statistics'])->name('index.statistics.locale');
});

// Default routes (Czech - no prefix)
Route::get('/', [IndexController::class, 'index'])->name('index.index');
Route::get('/webcam/big', [IndexController::class, 'webcamBig'])->name('index.webcam.big');
Route::get('/statistics', [IndexController::class, 'statistics'])->name('index.statistics');
