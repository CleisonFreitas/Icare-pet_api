<?php

use App\Http\Middleware\EnsureClient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => $e->getMessage() ?: 'Arquivo/rota não localizado.'
            ], Response::HTTP_NOT_FOUND);
        });
        $exceptions->render(function (Throwable $e, Request $request) {
            return response()->json([
                'status' => $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage() ?: 'Erro interno do servidor.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        });
        $exceptions->render(function (ModelNotFoundException $e) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => $e->getMessage() ?: 'Recurso não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        });
    })->create();
