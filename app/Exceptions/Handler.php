<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof ValidationException){
            $response = [
                'error'   => 'One or more fields are invalid',
                'message' => $exception->validator->errors()->messages()
            ];
            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        if($exception instanceof ModelNotFoundException){
            $response = [
                'error'   => 'Not Found',
            ];
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        if(env('APP_ENV') !== 'development'){
            return new JsonResponse(['error' => "Internal Server Error"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }



        return parent::render($request, $exception);
    }
}
