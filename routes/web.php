<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/cart', function () {
    return view('cart');
});
Route::group(['prefix' => 'users'], function () {

    Route::get('admin', [AdminController::class, 'index'])->name('users.admin');
    Route::post('admin-add', [AdminController::class, 'store'])->name('users.add-new-product');
    Route::post('admin-edit-products', [AdminController::class, 'updateProduct'])->name('users.edit-product');
    Route::post('login', [UserController::class, 'login'])->name('users.login');
    Route::post('register', [UserController::class, 'store'])->name('users.register');
    Route::get('category', [ProductController::class, 'index'])->name('users.category');
    Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('users.product-delete');
    Route::get('getProduct/{id}', [AdminController::class, 'getProductById']);
    Route::post('admin-search', [AdminController::class, 'search'])->name('users.search-admin');
    Route::get('search-admin-ajax', [AdminController::class, 'searchajax'])->name('users.search-admin-ajax');
    Route::post('search-page-admin', [ProductController::class, 'searchNav'])->name('users.search-nav');
    Route::post('search-page-category', [ProductController::class, 'searchCategory'])->name('users.search-category');

});
