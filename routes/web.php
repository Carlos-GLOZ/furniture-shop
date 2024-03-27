<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;

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

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/auth/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::post('/auth/signup', [AuthController::class, 'register']);
Route::get('/auth/signin', [AuthController::class, 'signin'])->name('auth.signin');
Route::post('/auth/signin', [AuthController::class, 'login']);
Route::get('/auth/signout', [AuthController::class, 'logout'])->name('auth.signout');

// Payment through PAYPAL
Route::post('/products/pay', [ProductController::class, 'pagar'])->name('product.pay');
Route::get('/products/afterpurchase', [ProductController::class, 'afterPurchase'])->name('product.bought');

//EMAIL
Route::get('/enviarEmail', [AuthController::class, 'enviarEmail'])->name('enviarEmail');
Route::post('/FuncionMail',[AuthController::class,'FuncionMail'])->name('FuncionMail');
Route::post('/listarCorreos',[AuthController::class,'listarCorreos'])->name('listarCorreos');

// Products
Route::post('/products', [ProductController::class, 'show'])->name('product.show');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::get('/products/{id}', [ProductController::class, 'find'])->name('product.find');
Route::post('/products/table',[ProductController::class, 'table'])->name('product.table');
Route::delete('/products/destroy',[ProductController::class, 'destroy'])->name('product.destroy');
Route::post('/products/store',[ProductController::class, 'store'])->name('product.store');
Route::put('/products/update',[ProductController::class, 'update'])->name('product.update');

// Reviews
Route::post('/reviews/store/{product}', [ReviewController::class, 'store'])->name('review.store');
Route::delete('/reviews/destroy/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');

// Cart
Route::get('/cart', [ShoppingCartController::class, 'show'])->name('cart.show');
Route::post('/cart/store/{product}', [ShoppingCartController::class, 'store'])->name('cart.store');
Route::delete('/cart/destroy/{product}', [ShoppingCartController::class, 'destroy'])->name('cart.destroy');

// Test
Route::get('/test', [ProductController::class, 'test'])->name('test');