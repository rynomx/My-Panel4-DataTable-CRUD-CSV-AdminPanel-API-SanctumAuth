<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\vlfdataController;
use App\Http\Controllers\API\AuthController;

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

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/v1/vlfdata/lookup/{vType}/{vMake}/{vModel}/{fType}/{variant}', [vlfdataController::class, 'lookup']);
});

//Non protected Routes
Route::post('/signup', [AuthController::class, 'register']);
Route::post('/signin', [AuthController::class, 'login']);

// Route::get('/v1/vlfdata', [vlfdataController::class, 'index']);
// Route::get('/v1/vlfdata/create', [vlfdataController::class, 'create']);
// Route::post('/v1/vlfdata/store', [vlfdataController::class, 'store']);
// Route::get('/v1/vlfdata/edit/{id}', [vlfdataController::class, 'edit']);
// Route::put('/v1/vlfdata/update/{id}', [vlfdataController::class, 'update']);
// Route::get('/v1/vlfdata/show/{id}', [vlfdataController::class, 'show']);
// Route::get('/v1/vlfdata/destroy/{id}', [vlfdataController::class, 'destroy']);

