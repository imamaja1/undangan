<?php

use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\WeddingController;
use App\Http\Controllers\Admin\WishController as AdminWishController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\WhatsappController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Guest\WishController;
use App\Http\Controllers\WeddingPageController;
use Illuminate\Support\Facades\Route;

// Redirect old dashboard URL
Route::redirect('/dashboard', '/admin');

// Guest - Wedding Invitation Page
Route::get('/', [WeddingPageController::class, 'index'])->name('wedding.index');

// Guest - Submit Wish
Route::post('/wishes', [WishController::class, 'store'])->name('wishes.store');

// Auth routes (Laravel Breeze)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.alt');

    // Wedding Configuration
    Route::get('/wedding', [WeddingController::class, 'edit'])->name('wedding.edit');
    Route::post('/wedding', [WeddingController::class, 'update'])->name('wedding.update');

    // Events
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'update'])->name('events.update');

    // Stories CRUD
    Route::resource('stories', StoryController::class)->only(['index', 'store', 'update', 'destroy']);

    // Galleries CRUD
    Route::resource('galleries', GalleryController::class)->only(['index', 'store', 'update', 'destroy']);

    // Gifts
    Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.index');
    Route::post('/gifts', [GiftController::class, 'update'])->name('gifts.update');
    Route::post('/gifts/bank', [GiftController::class, 'storeBank'])->name('gifts.storeBank');
    Route::put('/gifts/bank/{bankAccount}', [GiftController::class, 'updateBank'])->name('gifts.updateBank');
    Route::delete('/gifts/bank/{bankAccount}', [GiftController::class, 'destroyBank'])->name('gifts.destroyBank');

    // Wishes (admin)
    Route::resource('wishes', AdminWishController::class)->only(['index', 'destroy']);

    // Image upload + list
    Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
    Route::get('/images', [UploadController::class, 'images'])->name('images');

    // Otomasi WA
    Route::get('/whatsapp', [WhatsappController::class, 'index'])->name('whatsapp.index');
    Route::post('/whatsapp/key', [WhatsappController::class, 'saveKey'])->name('whatsapp.saveKey');
    Route::post('/whatsapp/generate-key', [WhatsappController::class, 'generateKey'])->name('whatsapp.generateKey');
    Route::get('/whatsapp/status', [WhatsappController::class, 'status'])->name('whatsapp.status');
    Route::get('/whatsapp/qr', [WhatsappController::class, 'qr'])->name('whatsapp.qr');
    Route::post('/whatsapp/send', [WhatsappController::class, 'send'])->name('whatsapp.send');
    Route::post('/whatsapp/logout', [WhatsappController::class, 'logout'])->name('whatsapp.logout');

    // Buku Tamu
    Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::post('/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::put('/guests/{guest}', [GuestController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{guest}', [GuestController::class, 'destroy'])->name('guests.destroy');
    Route::post('/guests/bulk-paste', [GuestController::class, 'bulkPaste'])->name('guests.bulkPaste');
    Route::post('/guests/template', [GuestController::class, 'saveTemplate'])->name('guests.saveTemplate');
    Route::post('/guests/{guest}/send-wa', [GuestController::class, 'sendWa'])->name('guests.sendWa');

    // Asset (background & audio)
    Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
    Route::post('/assets/bg', [AssetController::class, 'uploadBg'])->name('assets.uploadBg');
    Route::delete('/assets/bg/{section}', [AssetController::class, 'deleteBg'])->name('assets.deleteBg');
    Route::post('/assets/audio', [AssetController::class, 'uploadAudio'])->name('assets.uploadAudio');
    Route::delete('/assets/audio', [AssetController::class, 'deleteAudio'])->name('assets.deleteAudio');
});

require __DIR__.'/auth.php';
