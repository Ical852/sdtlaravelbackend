<?php

use App\Http\Controllers\FoodApiController;
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

Route::get('/food', [FoodApiController::class, 'getAll']);
Route::post('/food', [FoodApiController::class, 'create']);
Route::get('/food/{id}', [FoodApiController::class, 'getById']);
Route::post('/food/{id}', [FoodApiController::class, 'update']);
Route::delete('/food/{id}', [FoodApiController::class, 'delete']);
Route::post('/food/photo/{id}', [FoodApiController::class, 'updatepic']);