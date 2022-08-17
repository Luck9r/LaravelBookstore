<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShoppingCartController;
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

Route::get('/', [StoreController::class, 'getBooks'])
    ->name('store');

Route::get('/dashboard', [DashboardController::class, 'getData'])
    ->middleware(['auth'])->name('dashboard');

Route::get('/shopping_cart', [ShoppingCartController::class, 'getShoppingCartItems'])
    ->middleware(['auth'])->name('shopping_cart');

Route::post('/dashboard/users/modify', [UserController::class, 'modify'])
    ->name('users_modify');

Route::post('/dashboard/books/modify', [BookController::class, 'modify'])
    ->name('books_modify');

Route::post('/shopping_cart/modify', [ShoppingCartController::class, 'modify'])
    ->name('shopping_cart_modify');

Route::post('/dashboard/books/add', [BookController::class, 'add'])
    ->name('books_add');

require __DIR__.'/auth.php';
