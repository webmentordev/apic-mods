<?php

use App\Http\Controllers\CoolerController;
use App\Http\Controllers\BuildCategoryController;
use App\Http\Controllers\CustomLoopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FanController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GpuController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\MemoryTypeController;
use App\Http\Controllers\MotherboardController;
use App\Http\Controllers\NvmeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PcCaseController;
use App\Http\Controllers\ProcessorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsuController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SleeveController;
use App\Http\Controllers\SocketController;
use App\Http\Controllers\SsdController;
use App\Livewire\BuildPC;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::get('/build-your-pc', BuildPC::class)->name('build.pc');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::get('/processor-create', [ProcessorController::class, 'create'])->name('processor.create');
    Route::post('/processor', [ProcessorController::class, 'store']);
    Route::PATCH('/processor/update-status/{processor}', [ProcessorController::class, 'active'])->name('processor.status.update');
    Route::delete('/processor/delete/{processor}', [ProcessorController::class, 'delete'])->name('processor.delete');
    Route::get('/processor/update/{processor}', [ProcessorController::class, 'update'])->name('update.processor');
    Route::patch('/processor/update-processor/{processor}', [ProcessorController::class, 'update_processor'])->name('processor.update');

    Route::get('/motherboard', [MotherboardController::class, 'index'])->name('motherboard');
    Route::get('/motherboard-create', [MotherboardController::class, 'create'])->name('motherboard.create');
    Route::post('/motherboard', [MotherboardController::class, 'store']);
    Route::PATCH('/motherboard/update-status/{motherboard}', [MotherboardController::class, 'active'])->name('motherboard.status.update');
    Route::delete('/motherboard/delete/{motherboard}', [MotherboardController::class, 'delete'])->name('motherboard.delete');
    Route::get('/motherboard/update/{motherboard}', [MotherboardController::class, 'update'])->name('update.motherboard');
    Route::patch('/motherboard/update-motherboard/{motherboard}', [MotherboardController::class, 'update_motherboard'])->name('motherboard.update');

    Route::get('/sizes', [SizeController::class, 'index'])->name('size');
    Route::post('/sizes', [SizeController::class, 'store']);
    Route::delete('/sizes/delete/{size}', [SizeController::class, 'delete'])->name('size.delete');

    Route::get('/sockets', [SocketController::class, 'index'])->name('socket');
    Route::post('/sockets', [SocketController::class, 'store']);
    Route::delete('/sockets/delete/{socket}', [SocketController::class, 'delete'])->name('socket.delete');

    Route::get('/memory-type', [MemoryTypeController::class, 'index'])->name('memory.type');
    Route::post('/memory-type', [MemoryTypeController::class, 'store']);
    Route::delete('/memory-type/delete/{memory-type}', [MemoryTypeController::class, 'delete'])->name('memory.type.delete');

    Route::get('/memory', [MemoryController::class, 'index'])->name('memory');
    Route::get('/memory/create', [MemoryController::class, 'create'])->name('memory.create');
    Route::post('/memory', [MemoryController::class, 'store']);
    Route::delete('/memory/delete/{memory}', [MemoryController::class, 'delete'])->name('memory.delete');
    Route::get('/memory/update/{memory}', [MemoryController::class, 'update'])->name('update.memory');
    Route::patch('/memory/update/{memory}', [MemoryController::class, 'update_memory'])->name('memory.update');

    Route::get('/ssd', [SsdController::class, 'index'])->name('ssd');
    Route::get('/ssd/create', [SsdController::class, 'create'])->name('ssd.create');
    Route::post('/ssd', [SsdController::class, 'store']);
    Route::PATCH('/ssd/update/status/{ssd}', [SsdController::class, 'active'])->name('ssd.status.update');
    Route::delete('/ssd/delete/{ssd}', [SsdController::class, 'delete'])->name('ssd.delete');
    Route::get('/ssd/update/{ssd}', [SsdController::class, 'update'])->name('update.ssd');
    Route::patch('/ssd/update/{ssd}', [SsdController::class, 'update_ssd'])->name('ssd.update');

    Route::get('/nvme', [NvmeController::class, 'index'])->name('nvme');
    Route::get('/nvme/create', [NvmeController::class, 'create'])->name('nvme.create');
    Route::post('/nvme', [NvmeController::class, 'store']);
    Route::PATCH('/nvme/update/status/{nvme}', [NvmeController::class, 'active'])->name('nvme.status.update');
    Route::delete('/nvme/delete/{nvme}', [NvmeController::class, 'delete'])->name('nvme.delete');
    Route::get('/nvme/update/{nvme}', [NvmeController::class, 'update'])->name('update.nvme');
    Route::patch('/nvme/update/{nvme}', [NvmeController::class, 'update_nvme'])->name('nvme.update');

    Route::get('/gpu', [GpuController::class, 'index'])->name('gpu');
    Route::get('/gpu/create', [GpuController::class, 'create'])->name('gpu.create');
    Route::post('/gpu', [GpuController::class, 'store']);
    Route::PATCH('/gpu/update/status/{gpu}', [GpuController::class, 'active'])->name('gpu.status.update');
    Route::delete('/gpu/delete/{gpu}', [GpuController::class, 'delete'])->name('gpu.delete');
    Route::get('/gpu/update/{gpu}', [GpuController::class, 'update'])->name('update.gpu');
    Route::patch('/gpu/update/{gpu}', [GpuController::class, 'update_gpu'])->name('gpu.update');

    Route::get('/psu', [PsuController::class, 'index'])->name('psu');
    Route::get('/psu/create', [PsuController::class, 'create'])->name('psu.create');
    Route::post('/psu', [PsuController::class, 'store']);
    Route::PATCH('/psu/update/status/{psu}', [PsuController::class, 'active'])->name('psu.status.update');
    Route::delete('/psu/delete/{psu}', [PsuController::class, 'delete'])->name('psu.delete');
    Route::get('/psu/update/{psu}', [PsuController::class, 'update'])->name('update.psu');
    Route::patch('/psu/update/{psu}', [PsuController::class, 'update_psu'])->name('psu.update');

    Route::get('/pc-case', [PcCaseController::class, 'index'])->name('case');
    Route::get('/pc-case/create', [PcCaseController::class, 'create'])->name('case.create');
    Route::post('/pc-case', [PcCaseController::class, 'store']);
    Route::PATCH('/pc-case/update/status/{pccase}', [PcCaseController::class, 'active'])->name('case.status.update');
    Route::delete('/pc-case/delete/{pccase}', [PcCaseController::class, 'delete'])->name('case.delete');
    Route::get('/pc-case/update/{pccase}', [PcCaseController::class, 'update'])->name('update.case');
    Route::patch('/pc-case/update/{pccase}', [PcCaseController::class, 'update_case'])->name('case.update');

    Route::get('/cooler', [CoolerController::class, 'index'])->name('cooler');
    Route::get('/cooler/create', [CoolerController::class, 'create'])->name('cooler.create');
    Route::post('/cooler', [CoolerController::class, 'store']);
    Route::PATCH('/cooler/update/status/{cooler}', [CoolerController::class, 'active'])->name('cooler.status.update');
    Route::delete('/cooler/delete/{cooler}', [CoolerController::class, 'delete'])->name('cooler.delete');
    Route::get('/cooler/update/{cooler}', [CoolerController::class, 'update'])->name('update.cooler');
    Route::patch('/cooler/update/{cooler}', [CoolerController::class, 'update_cooler'])->name('cooler.update');

    Route::get('/sleeve', [SleeveController::class, 'index'])->name('sleeve');
    Route::get('/sleeve/create', [SleeveController::class, 'create'])->name('sleeve.create');
    Route::post('/sleeve', [SleeveController::class, 'store']);
    Route::PATCH('/sleeve/update/status/{sleeve}', [SleeveController::class, 'active'])->name('sleeve.status.update');
    Route::delete('/sleeve/delete/{sleeve}', [SleeveController::class, 'delete'])->name('sleeve.delete');
    Route::get('/sleeve/update/{sleeve}', [SleeveController::class, 'update'])->name('update.sleeve');
    Route::patch('/sleeve/update/{sleeve}', [SleeveController::class, 'update_watercooler'])->name('sleeve.update');

    Route::get('/fan', [FanController::class, 'index'])->name('fan');
    Route::get('/fan/create', [FanController::class, 'create'])->name('fan.create');
    Route::post('/fan', [FanController::class, 'store']);
    Route::PATCH('/fan/update/status/{fan}', [FanController::class, 'active'])->name('fan.status.update');
    Route::delete('/fan/delete/{fan}', [FanController::class, 'delete'])->name('fan.delete');
    Route::get('/fan/update/{fan}', [FanController::class, 'update'])->name('update.fan');
    Route::patch('/fan/update/{fan}', [FanController::class, 'update_fan'])->name('fan.update');

    Route::get('/loop', [CustomLoopController::class, 'index'])->name('loop');
    Route::get('/loop/create', [CustomLoopController::class, 'create'])->name('loop.create');
    Route::post('/loop', [CustomLoopController::class, 'store']);
    Route::PATCH('/loop/update/status/{loop}', [CustomLoopController::class, 'active'])->name('loop.status.update');
    Route::delete('/loop/delete/{loop}', [CustomLoopController::class, 'delete'])->name('loop.delete');
    Route::get('/loop/update/{loop}', [CustomLoopController::class, 'update'])->name('update.loop');
    Route::patch('/loop/update/{loop}', [CustomLoopController::class, 'update_customloop'])->name('loop.update');
});

require __DIR__.'/auth.php';