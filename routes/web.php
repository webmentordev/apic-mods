<?php

use App\Http\Controllers\BuildCategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProcessorController;
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
    Route::PATCH('/package/update-status/{package}', [PackageController::class, 'active'])->name('package.status.update');
    Route::delete('/package/delete/{package}', [PackageController::class, 'delete'])->name('package.delete');
    Route::get('/package/update/{package}', [PackageController::class, 'update'])->name('update.package');
    Route::patch('/package/update-package/{package}', [PackageController::class, 'update_package'])->name('package.update');


    Route::get('/build-category', [BuildCategoryController::class, 'index'])->name('category');
    Route::post('/build-category', [BuildCategoryController::class, 'store']);
    Route::PATCH('/build-category/update-status/{category}', [BuildCategoryController::class, 'active'])->name('category.status.update');
    Route::PATCH('/build-category/update-featured/{category}', [BuildCategoryController::class, 'feature'])->name('category.featured.update');
    Route::delete('/build-category/delete/{category}', [BuildCategoryController::class, 'delete'])->name('category.delete');

    Route::get('/processor', [ProcessorController::class, 'index'])->name('processor');
    Route::post('/processor', [ProcessorController::class, 'store']);
    Route::PATCH('/processor/update-status/{processor}', [ProcessorController::class, 'active'])->name('processor.status.update');
    Route::delete('/processor/delete/{processor}', [ProcessorController::class, 'delete'])->name('processor.delete');
    Route::get('/processor/update/{processor}', [ProcessorController::class, 'update'])->name('update.processor');
    Route::patch('/processor/update-processor/{processor}', [ProcessorController::class, 'update_processor'])->name('processor.update');

});

require __DIR__.'/auth.php';