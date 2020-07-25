<?php

namespace App\Http\Controllers\Test;

use Collective\Annotations\Routing\Annotations\Annotations\Get;

trait v2
{
    /**
     * @Get("/v2/test", as="测试接口")
     */
    public function testV2()
    {
        dd(12);
    }
}
