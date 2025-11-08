<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CameraUploadController;

// API endpoint for camera upload (no CSRF protection, no redirects)
Route::post('/camera/upload', [CameraUploadController::class, 'upload'])->name('api.camera.upload');
