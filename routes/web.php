<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('category', CategoryController::class)->middleware(['auth']);

Route::resource('product', ProductController::class)->middleware(['auth']);

Route::post("/add-order-item", [OrderController::class, 'addOrderPart' ]);

Route::get('/cart', [OrderController::class, 'cart'])->name('cart')->middleware(['auth']);

Route::post('/remove-order-item', [OrderController::class, 'removeOrderPart' ])->name('removeOrderPart');

Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('placeOrder');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware(['auth']);

Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show')->middleware(['auth']);

Route::put('order/update/{id}', [OrderController::class, 'update'])->name('orders.update');

require __DIR__.'/auth.php';
