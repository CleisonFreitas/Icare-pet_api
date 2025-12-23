<?php

use App\Http\Controllers\App\ClientAuthController;
use App\Http\Controllers\App\ClientPetController;
use App\Http\Controllers\App\ClientScheduleController;
use App\Http\Middleware\ClientValidMiddleware;
use App\Http\Middleware\EnsureClient;
use Illuminate\Support\Facades\Route;

Route::prefix('app')->middleware('throttle:30,1')->group(function () {
        Route::prefix('auth')->group(function ($router) {
            $router->post('login', [ClientAuthController::class, 'login']);
            $router->post('register', [ClientAuthController::class, 'register']);

            $router->middleware('auth:sanctum')->group(function ($router) {
                $router->middleware(EnsureClient::class)->group(function ($router) {
                    $router->post('logout', [ClientAuthController::class, 'logout']);
                    $router->get('me', [ClientAuthController::class, 'me']);
                });
            });
        });

        Route::middleware(['auth:sanctum', EnsureClient::class])->group(function ($router) {
            $router->post('client/{clientId}/pet/register', [ClientPetController::class, 'register']);

            // Client actions
            $router->middleware(ClientValidMiddleware::class)->group(function ($router) {
                $router->put('client/{clientId}/schedule', [ClientScheduleController::class, 'schedule']);
            });
        });
});
