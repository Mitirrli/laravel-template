<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * 系统异常
 */
class SystemException extends \Exception
{
    public function render()
    {
        return response()->json([
            'code' => 67,
            'msg' => '服务器开小差了, 请稍后再试~',
            'data' => []
        ]);
    }
}
