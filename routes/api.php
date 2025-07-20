<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| Laravel provides a default route for authenticated users:
| Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
|     return $request->user();
| });
| You can keep or remove this default route as needed.
|
*/

// --- RESTful API Resource for Products ---
Route::apiResource('products', ProductController::class);
// --- END Product API Resource ---

