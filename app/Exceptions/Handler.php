<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
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
        BusinessException::class,
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
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Throwable
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        //* 验证异常
        if ($exception instanceof ValidationException) {
            return response()->json([
                'code' => 1003,
                'msg' => $exception->{'validator'}->errors()->first(),
                'data' => []
            ]);

            goto loop;
        }

        //* 业务异常
        if ($exception instanceof BusinessException) {
            return response()->json([
                'code' => $exception->getCode() ?? 1004,
                'msg' => $exception->getMessage() ?? 'Fail',
                'data' => []
            ]);

            goto loop;
        }

        //* 限制一分钟能调用接口次数
        if ($exception instanceof ThrottleRequestsException) {
            return response()->json([
                'code' => 429,
                'msg' => '操作过于频繁',
                'data' => []
            ]);
        }

        dd($exception);

        //! 系统异常
        return response()->json([
            'code' => 67,
            'msg' => 'System error!',
            'data' => []
        ]);

        loop:
        return parent::render($request, $exception);
    }
}
