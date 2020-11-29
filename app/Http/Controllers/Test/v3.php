<?php

declare(strict_types=1);

namespace App\Http\Controllers\Test;

use Collective\Annotations\Routing\Annotations\Annotations\Get;

trait v3
{
    /**
     * @Get("/v3/test", as="测试接口v3", domain="http://0.0.0.0")
     */
    public function testV3()
    {
        dd(13);
    }
}
