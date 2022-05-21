<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\APIV1\Modules\Orders\Controllers\OrderController;
use App\Http\APIV1\Modules\Autos\Controllers\AutoController;
use App\Http\APIV1\Modules\Clients\Controllers\ClientController;

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

Route::get('/v1/clients', [ClientController::class, 'getList']);

Route::get("/v1/clients/{id}",[ClientController::class, 'get']);

Route::post("/v1/clients", [ClientController::class, 'post']);

Route::delete("/v1/clients/{id}", [ClientController::class, 'delete']);

Route::patch("/v1/clients/{id}", [ClientController::class, 'patch']);

Route::put("/v1/clients/{id}", [ClientController::class, 'put']);

Route::get("/v1/orders",[OrderController::class, 'getList']);

Route::get("/v1/orders/{id}",[OrderController::class, 'get']);

Route::post("/v1/orders", [OrderController::class, 'post']);

Route::delete("/v1/orders/{id}", [OrderController::class, 'delete']);

Route::patch("/v1/orders/{id}", [OrderController::class, 'patch']);

Route::put("/v1/orders/{id}", [OrderController::class, 'put']);

Route::get("/v1/autos",[AutoController::class, 'getList']);

Route::get('/v1/autos/{id}',[AutoController::class, 'get']);

Route::post("/v1/autos", [AutoController::class, 'post']);

Route::delete("/v1/autos/{id}", [AutoController::class, 'delete']);

Route::patch("/v1/autos/{id}", [AutoController::class, 'patch']);

Route::put("/v1/autos/{id}", [AutoController::class, 'put']);

