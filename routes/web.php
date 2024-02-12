<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function() {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/', [DashboardController::class, 'search']);   
    Route::post('/purchase', [ReceiptController::class, 'store']);
    Route::patch('/store/update/{id}', [StoreController::class, 'update']);

    Route::prefix('product')->group(function (){
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('/detail/{id}', [ProductController::class, 'show']);
        Route::put('/update/{id}', [ProductController::class, 'update']);
        Route::post('/delete/{id}', [ProductController::class, 'destroy']);
    });
    Route::prefix('cart')->group(function() {
        Route::post('/', [CartController::class, 'store']);
        Route::post('/reset', [CartController::class, 'reset']);
        Route::post('/edit/{id}', [CartController::class, 'update']);
        Route::delete('/destroy/{id}', [CartController::class, 'destroy']);
    });
    Route::prefix('transaction')->group(function() {
        Route::get('/', [FinanceController::class, 'index']);
        Route::post('/', [FinanceController::class, 'filter']);
        Route::get('/receipt/{noTransaction}', [PurchaseDetailController::class, 'show']);
    });
    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});


require __DIR__.'/auth.php';
