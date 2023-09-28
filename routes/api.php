<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', function (Request $request) {
    return response()->json("Hello", 200);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('eitlogin', 'EITLogin');
    Route::post('stafflogin', 'StaffLogin');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    //routes for categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{categoryID}', [CategoryController::class, 'show']);

    //routes for meals
    Route::get('/meals', [MealController::class, 'index']);
    Route::get('/meals/{mealID}', [MealController::class, 'show']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});