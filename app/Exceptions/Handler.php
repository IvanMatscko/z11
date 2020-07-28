<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Custom\Common;

class Handler extends ExceptionHandler
{
    public static $exception_messages = [
        403         => 'exception_403',
        404         => 'exception_404',
        'unknown'   => 'exception_unknown',
    ];
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
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        // // var_dump(get_class($exception));
        // $language_block = Common::prepareLanguageBlock();
        // $search_block = Common::prepareSearchBlock();
        // if (method_exists($exception, 'getStatusCode'))
        // {
        //     $exception_code    = $exception->getStatusCode();
        // }
        // else
        // {
        //     if (is_object($exception))
        //     {
        //         if (get_class($exception) == 'Illuminate\Auth\AuthenticationException')
        //         {
        //             $exception_code    = 403;
        //         } elseif (get_class($exception) == 'Illuminate\Validation\ValidationException')
        //         {
        //             return parent::render($request, $exception);
        //         } else
        //         {
        //             $exception_code    = 'unknown';
        //         }
        //     } else
        //     {
        //         $exception_code    = 'unknown';
        //     }
        // }
        // return response()->view('exception', [
        //     'language_block'    => $language_block,
        //     'search_block'      => $search_block,
        //     'exception_code'    => $exception_code,
        //     'exception_message' => isset(self::$exception_messages[$exception_code]) ? 
        //         __('l.'.self::$exception_messages[$exception_code]) :
        //         __('l.'.self::$exception_messages['unknown']),
        // ]);
        return parent::render($request, $exception);
    }
}
