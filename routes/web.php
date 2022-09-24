<?php

use App\Http\Controllers\FoodController;
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

Route::get('/', [FoodController::class, 'index']);
Route::get('/create', [FoodController::class, 'create']);
Route::post('/store', [FoodController::class, 'store']);
Route::get('/edit/{id}', [FoodController::class, 'edit']);
Route::post('/update/{id}', [FoodController::class, 'update']);
Route::get('/editpic/{id}', [FoodController::class, 'editpic']);
Route::post('/updatepic/{id}', [FoodController::class, 'updatepic']);
Route::post('/delete/{id}', [FoodController::class, 'destroy']);