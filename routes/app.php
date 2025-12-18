<?php

use App\Http\Controllers\App\ClientAuthController;
use App\Http\Middleware\EnsureClient;
use Illuminate\Support\Facades\Route;

Route::prefix('app')->middleware('throttle:30,1')->group(function () {
    Route::controller(ClientAuthController::class)->group(function ($router) {

        $router->prefix('auth')->group(function ($router) {
            $router->post('login', 'login');
            $router->post('register', 'register');

            $router->middleware('auth:sanctum')->group(function ($router) {
                $router->middleware(EnsureClient::class)->group(function ($router) {
                    $router->post('logout', 'logout');
                    $router->get('me', 'me');
                });
            });
        });
    });
});
