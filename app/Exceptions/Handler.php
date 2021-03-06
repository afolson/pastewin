<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use App\Http\Controllers\ApiController;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $e
     * @return mixed
     */
    public function render($request, Exception $e) {
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $api = new ApiController();
            return $api->respondNotFound($message = 'Not Found');
        }
    }
}
