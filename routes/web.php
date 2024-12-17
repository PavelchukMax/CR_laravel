<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return redirect()->route('blogs.all');})->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/blogs', [BlogController::class, 'allBlogs'])->name('blogs.all'); 
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
Route::resource('auth', AuthController::class);
Route::middleware(['role:user|admin'])->group(function () {
    Route::get('/profile', [PageController::class, 'profile_page'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/my-blogs', [BlogController::class, 'myBlogs'])->name('my.blogs');
    Route::get('/create-blog', [BlogController::class, 'create'])->name('blogs.create'); 
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});
