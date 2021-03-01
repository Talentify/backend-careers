<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
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
     * @throws \Throwable
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
        if ($exception instanceof ValidationException) {
            return response(
                [
                    'status' => [
                        'code' => 400,
                        'message' => "Bad Requests"
                    ],
                    'Error' => $exception->validator->errors()->first()
                ]
            )->setStatusCode(400);
        }

        if ($exception instanceof UnauthorizedHttpException || $exception instanceof AuthenticationException) {
            return response(
                [
                    'status' => [
                        'code' => 401,
                        'message' => "Unauthorized"
                    ],
                    'Error' => "Unauthorized"
                ]
            )->setStatusCode(401);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response(
                [
                    'status' => [
                        'code' => 404,
                        'message' => "Not Found"
                    ],
                    'Error' => "Not Found"
                ]
            )->setStatusCode(404);
        }

        if ($exception instanceof FileNotFoundException) {
            return response(
                [
                    'status' => [
                        'code' => 404,
                        'message' => "Not Found"
                    ],
                    'Error' => "File Not Found"
                ]
            )->setStatusCode(404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response(
                [
                    'status' => [
                        'code' => 405,
                        'message' => "Method Not Allowed"
                    ],
                    'Error' => "This method is not supported for this route."
                ]
            )->setStatusCode(405);
        }

        return response(
            [
                'status' => [
                    'code' => 500,
                    'message' => "Internal Server Error"
                ],
                'Error' => $exception->getMessage()
            ]
        )->setStatusCode(500);
    }
}
