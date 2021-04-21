<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'msg' => 'Unauthenticated. It\'s necessary to be authenticated to access this endpoint'
            ], 401);

        } else if ($exception instanceof UnauthorizedException) {
            return response()->json([
                'msg' => $exception->getMessage() ?? "This user doesn't have permission to perform this action."
            ], 403);

        } else if ($exception instanceof ValidationException) {
            return response()->json([
                'msg' => $exception->errors()
            ], 422);

        } else if ($exception instanceof ModelNotFoundException) {

            return response()->json([
                'error' => class_basename($exception->getModel()) . ' not found!'
            ], 404);

        } else if ($exception instanceof QueryException) {
            if ($exception->errorInfo[1] === 1062) {
                return response()->json([
                    'error' => 'A record already exists with this field and can\'t be duplicate!'
                ], 422);
            }
        }

        $errorDescription = <<<TEXT
            ERROR:
                MESSAGE: {$exception->getMessage()}
                FILE: {$exception->getFile()}
                LINE: {$exception->getLine()}
                CODE: {$exception->getCode()}
                STACKTRACE: {$exception->getTraceAsString()}
TEXT;
        Log::debug($errorDescription);

        if (App::environment() === 'production') {
            return response()->json([
                'error' => 'An error occurred. Check the logs for more information.'
            ], 500);

        } else {
            return response()->json([
                'error' => $exception
            ], 500);

        }

        return parent::render($request, $exception);
    }
}
