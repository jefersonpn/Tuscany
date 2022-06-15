<?php

use Illuminate\Support\Facades\Route;
use App\Http\Resources\CategoryCollection;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CategoriesController;

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

Route::get('/', [App\Http\Controllers\Api\CategoriesController::class, 'principale']);
Route::get('/{code}', [App\Http\Controllers\Api\CategoriesController::class, 'GetProducts']);
Route::get('/colorSelected/{colorSelected}', [App\Http\Controllers\Api\CategoriesController::class, 'showItemSelect']);
Route::get('/language/{lang}', [App\Http\Controllers\Api\CategoriesController::class, 'principale']);