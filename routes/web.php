<?php

use App\Http\Controllers\Admin\AboutContentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventPosterController as AdminEventPosterController;
use App\Http\Controllers\Admin\HeroSettingController;
use App\Http\Controllers\Admin\ScheduleEventController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TrailRouteController;
use App\Http\Controllers\Admin\TrailRoutePhotoController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Contributor\AuthController as ContributorAuthController;
use App\Http\Controllers\Contributor\EventPosterController as ContributorEventPosterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// ===== SUPERADMIN =====
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'superadmin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('routes', TrailRouteController::class)->except(['show']);
        Route::post('/routes/{route}/photos', [TrailRoutePhotoController::class, 'store'])->name('routes.photos.store');
        Route::delete('/routes/{route}/photos/{photo}', [TrailRoutePhotoController::class, 'destroy'])->name('routes.photos.destroy');
        Route::resource('schedule', ScheduleEventController::class)->except(['show']);

        Route::get('/about', [AboutContentController::class, 'edit'])->name('about.edit');
        Route::put('/about', [AboutContentController::class, 'update'])->name('about.update');

        Route::get('/hero', [HeroSettingController::class, 'edit'])->name('hero.edit');
        Route::put('/hero', [HeroSettingController::class, 'update'])->name('hero.update');

        Route::get('/branding', [SiteSettingController::class, 'edit'])->name('branding.edit');
        Route::put('/branding', [SiteSettingController::class, 'update'])->name('branding.update');

        Route::get('/posters', [AdminEventPosterController::class, 'index'])->name('posters.index');
        Route::get('/posters/{poster}/edit', [AdminEventPosterController::class, 'edit'])->name('posters.edit');
        Route::put('/posters/{poster}', [AdminEventPosterController::class, 'update'])->name('posters.update');
        Route::patch('/posters/{poster}/status', [AdminEventPosterController::class, 'updateStatus'])->name('posters.status.update');
        Route::delete('/posters/{poster}', [AdminEventPosterController::class, 'destroy'])->name('posters.destroy');

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.role.update');
        Route::get('/users/{user}/reset-password', [AdminUserController::class, 'showResetPassword'])->name('users.password.edit');
        Route::patch('/users/{user}/reset-password', [AdminUserController::class, 'resetPassword'])->name('users.password.update');
    });
});

// ===== KONTRIBUTOR =====
Route::prefix('kontributor')->name('contributor.')->group(function () {
    Route::get('/daftar', [ContributorAuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [ContributorAuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [ContributorAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [ContributorAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [ContributorAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [ContributorEventPosterController::class, 'index'])->name('dashboard');
        Route::post('/poster', [ContributorEventPosterController::class, 'store'])->name('poster.store');
        Route::delete('/poster/{poster}', [ContributorEventPosterController::class, 'destroy'])->name('poster.destroy');
    });
});
