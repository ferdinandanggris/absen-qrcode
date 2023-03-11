<?php

use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/users')->group(function () {
    Route::get('/getAll', [UserController::class, 'getAll']);
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post("/", [UserController::class, 'store']);
    Route::put("/", [UserController::class, 'update']);
    Route::put("/update-password", [UserController::class, 'updatePassword']);
    Route::delete("/{id}", [UserController::class, 'delete']);
});
