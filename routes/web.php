<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


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

Route::resource('category', CategoryController::class)->middleware('is_admin');
Route::post('category/delete',[CategoryController::class, 'destroy'])->name('category.delete')->middleware('is_admin');

// Route::resource('product', ProductController::class);
Route::post('product/delete',[ProductController::class, 'destroy'])->name('product.delete')->middleware('is_admin');
Route::get('product/create',[ProductController::class, 'create'])->name('product.create')->middleware('is_admin');
Route::post('product/store',[ProductController::class, 'store'])->name('product.store')->middleware('is_admin');
Route::get('product/edit/{id}',[ProductController::class, 'edit'])->name('product.edit')->middleware('is_admin');
Route::post('product/update/{id}',[ProductController::class, 'update'])->name('product.update')->middleware('is_admin');
Route::get('product',[ProductController::class, 'index'])->name('product.index');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
 })->name('user.logout');