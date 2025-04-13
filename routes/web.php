<?php

use App\Http\Controllers\StatusPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceGroupController;
use App\Http\Controllers\Admin\IncidentController;
use App\Http\Controllers\BotStatusController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

// Public status page
Route::get('/', [StatusPageController::class, 'index'])->name('status.index');
Route::get('/status/iframe', [StatusPageController::class, 'iframe'])->name('status.iframe');
// Bot status reporting API
Route::post('/api/bot-status', [BotStatusController::class, 'reportStatus'])->name('bot.status.report');

// Admin routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Routes that require admin status
    Route::middleware(AdminMiddleware::class)->group(function () {
        // Service Groups
        Route::resource('service-groups', ServiceGroupController::class);
        
        // Services
        Route::resource('services', ServiceController::class);
        Route::get('services/{service}/check', [ServiceController::class, 'check'])->name('services.check');
        
        // Incidents
        Route::resource('incidents', IncidentController::class);
    });
});

// Auth routes (included by Laravel auth scaffolding)
Route::view('login', 'auth.login')->name('login');
Route::post('login', function () {
    if (Auth::attempt(request(['email', 'password']))) {
        return redirect()->intended('admin');
    }
    return back()->withErrors(['email' => 'Invalid credentials']);
})->name('login.attempt');

Route::post('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');
