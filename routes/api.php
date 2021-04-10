<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    //тестовый api
    Route::middleware('cors')->post('/act/test', [UserController::class, 'test']);

    //user api
    Route::middleware('cors')->post('/logout', [AuthController::class, 'logout']);
    Route::middleware('cors')->post('/getuser', [UserController::class, 'getuser']);

    //act api
    Route::middleware('cors')->post('/act', [ActController::class, 'store']);
    Route::middleware('cors')->post('/act/changestatus', [ActController::class, 'changeStatus']);
    Route::middleware('cors')->get('/act', [ActController::class, 'index']);

    //worker api
    Route::middleware('cors')->get('/worker/{id}', [WorkerController::class, 'indexByActId']);
    Route::middleware('cors')->put('/worker/{id}', [WorkerController::class, 'update']);
    Route::middleware('cors')->post('/worker/detach', [WorkerController::class, 'destroy']);
    Route::middleware('cors')->post('/worker/{id}', [WorkerController::class, 'addFile']);
    Route::middleware('cors')->post('/worker', [WorkerController::class, 'store']);
});
