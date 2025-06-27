<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\SearchController;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CategoryController;



Route::get('/', function () {
    $categories = Category::all();
    return view('welcome', compact('categories'));
});

Route::get('/search', [SearchController::class, 'search']);

Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
Route::post('/ads', [AdController::class, 'store'])->name('ads.store');



Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/test-thumb', function () {
    $ad = Ad::find(1);
    $media = $ad->getFirstMedia('ads');

    dd([
        'original' => $media?->getUrl(),
        'thumb'    => $media?->getUrl('thumb'),
        'exists'   => $media?->hasGeneratedConversion('thumb'),
    ]);
});



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
