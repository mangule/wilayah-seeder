<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('daftar', 'pages::daftar')->name('daftar');
    Route::livewire('daftar2', 'pages::daftar2')->name('daftar2');
});

require __DIR__.'/settings.php';
