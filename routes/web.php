<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::post('/gallery', [GalleryController::class, 'store']);
    Route::PATCH('/gallery/update-status/{gallery:id}', [GalleryController::class, 'active'])->name('gallery.status.update');
    Route::delete('/gallery/delete/{gallery:id}', [GalleryController::class, 'delete'])->name('gallery.delete');

    Route::get('/package', [PackageController::class, 'index'])->name('package');
    Route::get('/package/create', [PackageController::class, 'create'])->name('create.package');
    Route::post('/package', [PackageController::class, 'store'])->name('package.create');
    Route::PATCH('/package/update-status/{package:id}', [PackageController::class, 'active'])->name('package.status.update');
    Route::delete('/package/delete/{package:id}', [PackageController::class, 'delete'])->name('package.delete');

    Route::get('/package/update/{package:id}', [PackageController::class, 'update'])->name('update.package');
    Route::patch('/package/update-package/{package:id}', [PackageController::class, 'update_package'])->name('package.update');

});

require __DIR__.'/auth.php';