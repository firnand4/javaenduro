<?php

use App\Http\Controllers\Admin\AboutContentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\ScheduleEventController;
use App\Http\Controllers\Admin\TrailRouteController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('routes', TrailRouteController::class)->except(['show']);
        Route::resource('schedule', ScheduleEventController::class)->except(['show']);
        Route::resource('gallery', GalleryItemController::class)->except(['show']);

        Route::get('/about', [AboutContentController::class, 'edit'])->name('about.edit');
        Route::put('/about', [AboutContentController::class, 'update'])->name('about.update');
    });
});
