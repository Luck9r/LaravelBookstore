<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
    return view('store');
})->name('store');

Route::get('/dashboard', [UserController::class, 'getUsers'])
    ->middleware(['auth'])->name('dashboard');

Route::get('/shopping_cart', function ()
{
    return view('shopping_cart');
})->middleware(['auth'])->name('shopping_cart');;

require __DIR__.'/auth.php';
