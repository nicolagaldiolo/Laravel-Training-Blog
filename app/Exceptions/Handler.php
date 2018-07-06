<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        // non serve fare questa cosa perchè laravel lo fa per noi, ma se fosse un eccezzione
        // mia allora la devo gestire così
        if($exception instanceof AuthorizationException){
            abort('403');
        }

        if($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException){
            return response()->json([
                'result' => 'error',
                'message' => $exception->getMessage()
            ]);
        }


        return parent::render($request, $exception);
    }
}