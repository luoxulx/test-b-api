<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response as HttpCodeResponse;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,

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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->is('api/*')) {
            if ($exception instanceof NotFoundHttpException) {
                $defaultMessage = 'Interface of api is not exist';
                $code = HttpCodeResponse::HTTP_NOT_FOUND;
            }
            elseif ($exception instanceof AccessDeniedHttpException) {
                $defaultMessage = 'HTTP: Forbidden';
                $code = HttpCodeResponse::HTTP_FORBIDDEN;
            }
            elseif ($exception instanceof MethodNotAllowedHttpException) {
                $defaultMessage = 'Method not allowed';
                $code = HttpCodeResponse::HTTP_METHOD_NOT_ALLOWED;
            }
            elseif ($exception instanceof ValidationHttpException) {
                $defaultMessage = 'Data validation failed';
                $code = HttpCodeResponse::HTTP_UNPROCESSABLE_ENTITY;
            }
            elseif ($exception instanceof UnauthorizedException) {
                $defaultMessage = 'Unauthorized';
                $code = HttpCodeResponse::HTTP_UNAUTHORIZED;
            }
            elseif ($exception instanceof TooManyRequestsHttpException) {
                $defaultMessage = 'Client requests are too frequent';
                $code = HttpCodeResponse::HTTP_TOO_MANY_REQUESTS;
            }
            elseif ($exception instanceof ServiceUnavailableHttpException) {
                $defaultMessage = 'Service Unavailable';
                $code = HttpCodeResponse::HTTP_SERVICE_UNAVAILABLE;
            }
            else{
                $defaultMessage = 'Bad request';
                $code = HttpCodeResponse::HTTP_BAD_REQUEST;
            }

            $response['status'] = false;
            $response['code'] = $code;
            $response['message'] = $defaultMessage;
            $response['debug'] = $exception->getMessage() ?? $defaultMessage;
            if (config('app.debug') === true) {
                $response['line'] = $exception->getTrace()[0] ?? '';
            }

            return response()->json($response, $code);
        }

        return parent::render($request, $exception);
    }
}
