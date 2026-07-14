<?php
use Illuminate\Support\Facades\Route;

// Guest
Route::view('/', 'welcome')->name('home');
Route::livewire('landingpage','pages::guest.home')->name('landingpage');
Route::livewire('diagnosis','pages::guest.diagnosis')->name('diagnosis');
Route::livewire('diagnosis/result','pages::guest.result')->name('result');

// Admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
