<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ImageController;
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

Route::post('login', [AuthController::class, 'login']);

// Route::post('/image/upload', [ImageController::class, 'store']);

Route::group(
    ['middleware' => ['jwt.verify']],
    function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('/data', [DataController::class, 'index']);
        Route::post('/data/insert', [DataController::class, 'insert']);
        Route::get('/data/{id}/edit', [DataController::class, 'edit']);
        Route::post('/data/update', [DataController::class, 'update']);
        Route::post('/data/delete', [DataController::class, 'delete']);
    }
);
