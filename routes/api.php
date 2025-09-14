<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('testing', function(){
//     return "this is a test api";
// });

Route::post("login", [\App\Http\Controllers\Auth\AuthController::class, "login"]);
Route::post("register", [\App\Http\Controllers\Auth\AuthController::class, "register"]);
Route::post("logout", [\App\Http\Controllers\Auth\AuthController::class, "logout"])    ->middleware("auth:sanctum");
