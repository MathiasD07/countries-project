<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response(['error_message' => 'Not found.'], 404);
        }

        if ($exception instanceof HttpResponseException) {
            return response(['error_message' => $exception->getResponse()->getContent()], $exception->getResponse()->getStatusCode());
        }

        if ($exception instanceof QueryException) {
            return response(['error_message' => 'A database error has occurred'], 400);
        }

        return response(['error_message' => $exception->getMessage()], 500);
    }

}
