<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [AuthenticationController::class, 'register'])->name('user.register');
    Route::post('login', [AuthenticationController::class, 'login'])->name('user.login');
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('user.logout');

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::post('/', [ProductController::class, 'store'])->name('products.store');
            Route::patch('/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');
            Route::post('/', [OrderController::class, 'store'])->name('orders.store');
            Route::delete('/{order},', [OrderController::class, 'destroy'])->name('orders.destroy');
        });

        Route::group(['prefix' => 'invoices'], function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index');
            Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
            Route::delete('/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
        });
    });
});

