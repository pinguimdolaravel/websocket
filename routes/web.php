<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Volt::route('chat', 'pages.chat')->name('chat');
    Volt::route('blog-posts', 'pages.blog-posts')->name('blog-posts');
});

require __DIR__ . '/auth.php';
