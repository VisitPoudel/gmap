<?php

use App\Http\Controllers\CoordinateController;
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

Route::middleware('api')
    ->group(function() {
        Route::get("/coordinate/country", [CoordinateController::class, "getCountry"]);
        Route::get("/country/getAllCordinates", [CoordinateController::class, "getAllCordinates"]);
        Route::resource("/coordinate", CoordinateController::class);
    });
