<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddmallController;
use App\Http\Controllers\MallController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/Add-mall', [AddmallController::class, 'showAddMallForm'])->name('Add-mall');
Route::post('/Add-mall', [AddmallController::class, 'addmallform'])->name('addmall.submit');

Route::get('/mall-view', [MallController::class, 'index'])->name('mall-view');
Route::delete('/mall/{id}', [AddmallController::class, 'deleteMall'])->name('mall.delete');
Route::get('/mall/edit/{id}', [AddmallController::class, 'editMall'])->name('mall.edit');
Route::post('/mall/update/{id}', [AddmallController::class, 'updateMall'])->name('mall.update');

Route::get('/form', [YourController::class, 'showForm']);
Route::post('/store-city', [YourController::class, 'storeCity'])->name('store.city');
Route::post('/store-party', [PartyController::class, 'store'])->name('store.party');


Route::get('/new-order', [AddmallController::class, 'newOrder']);


Route::post('/orders', [AddmallController::class, 'store'])->name('Addmall.store');
Route::get('/orders/{id}', [AddmallController::class, 'newordersv'])->name('order.create');
Route::get('/order-view', [OrderController::class, 'vieworder'])->name('order-view');
Route::get('/order', [AddmallController::class, 'showOrders'])->name('order-view');
require __DIR__.'/auth.php';
