<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddmallController;
use App\Http\Controllers\MallController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MachineController;
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



Route::post('/store-party', [PartyController::class, 'store'])->name('store.party');


Route::get('/new-order', [AddmallController::class, 'newOrder']);


Route::post('/order', [AddmallController::class, 'store'])->name('Addmall.store');
Route::get('/orders/{id}', [AddmallController::class, 'newordersv'])->name('order.create');

Route::get('/order', [AddmallController::class, 'showOrders'])->name('order-view');
Route::delete('/order/{id}', [AddmallController::class, 'deleteOrder'])->name('order.delete');

Route::get('/orders', [AddmallController::class, 'makestore'])->name('makeorder.store');
Route::post('/orders', [AddmallController::class, 'makestore'])->name('makeorder.store');
Route::post('/orders/{id}', [AddmallController::class, 'makenewordersv'])->name('order.make');
Route::get('/orders-list', [OrderController::class, 'index'])->name('orders.index');
Route::get('/ordere/edit/{id}', [AddmallController::class, 'editorder'])->name('order.edit');
Route::post('/orderu/update/{id}', [AddmallController::class, 'updateorder'])->name('order.update');

Route::get('/order/{id}/to-machine', [MachineController::class, 'create'])->name('order.toMachine');
Route::post('/order/{id}/to-machine', [MachineController::class, 'store'])->name('order.sendToMachine');
Route::get('/machine-view', [MachineController::class, 'index'])->name('machine-view');
Route::delete('/machine/{id}', [MachineController::class, 'destroy'])->name('machine.delete');

require __DIR__.'/auth.php';
