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
        return response('Server Error', 500);
    }
}
