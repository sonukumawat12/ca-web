<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/services', function () {
    return Inertia::render('Services');
})->name('services');

Route::get('/pricing', function () {
    return Inertia::render('Pricing');
})->name('pricing');

Route::get('/blog', [FrontendController::class,'index'])->name('blog');
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/style-guide', function () {
    return Inertia::render('styles/GlobalStyles');
})->name('style-guide');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/dashboard/blogs', [BlogController::class,'index'])->name('dashboard.blogs');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::put('/blogs/{blog}/schedule', [BlogController::class, 'schedule'])->name('blogs.schedule');
});

   // Route::get('/dashboard/blogs', function () {
    //     return Inertia::render('dashboard/BlogManagement');
    // }
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
