<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * 业务异常.
 */
class BusinessException extends \Exception
{
    public function render()
    {
        return response()->json([
            'code' => $this->getCode() ?? 1004,
            'msg' => $this->getMessage() ?? 'Fail',
            'data' => [],
        ]);
    }
}
