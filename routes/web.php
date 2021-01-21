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
// Route::get('/admin', function () {
//     return view('admin');
// });
// Route::get('/single-product', function () {
//     return view('single-product');
// });
// Route::get('/category', function () {
//     return view('category');
// });
Route::group(['prefix' => 'users'], function () {

    Route::get('admin', [AdminController::class, 'index'])->name('users.admin');
    Route::post('admin', [AdminController::class, 'store'])->name('users.add-new-product');
    Route::post('admin/{id}', [AdminController::class, 'store'])->name('users.edit-product');
    Route::post('login', [UserController::class, 'login'])->name('users.login');
    Route::post('register', [UserController::class, 'store'])->name('users.register');
    Route::get('category', [ProductController::class, 'index'])->name('users.category');
    Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('users.product-delete');
});
// Route::group(['prefix' => 'users'], function () {

//     Route::get('admin', [AdminController::class, 'index'])->name('users.admin');
//     Route::post('admin', [AdminController::class, 'store'])->name('add-new-product');
//     Route::post('admin/{id}', [AdminController::class, 'store'])->name('edit-product');
//     Route::post('login', [UserController::class, 'login'])->name('users.login');
//     Route::post('register', [UserController::class, 'store'])->name('register');
//     Route::get('category', [ProductController::class, 'index'])->name('category');
//     Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('product-delete');
// });
