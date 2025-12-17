<?php

use App\Http\App\Controllers\ClientAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('app')->group(function () {
    Route::controller(ClientAuthController::class)->group(function ($router) {
        $router->post('login', 'login');
        $router->post('register', 'register');
        $router->post('logout', 'logout')->middleware('auth:sanctum');
    });
});