<?php

declare(strict_types = 1);

use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('download/{download}', DownloadController::class)->name('download');
    Volt::route('chat', 'pages.chat')->name('chat');
    Volt::route('blog-posts', 'pages.blog-posts.table')->name('blog-posts');
    Volt::route('blog-posts/create', 'pages.blog-posts.create')->name('blog-posts.create');
    Volt::route('blog-posts/edit/{post}', 'pages.blog-posts.edit')->name('blog-posts.edit');
    Volt::route('downloads', 'pages.downloads')->name('downloads');
});

require __DIR__ . '/auth.php';
