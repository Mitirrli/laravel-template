<?php

namespace App\Http\Controllers\Test;

use App\Http\Requests\TestRequest;
use Collective\Annotations\Routing\Annotations\Annotations\Get;

trait v2
{
    /**
     * @Get("/v2/test", as="测试接口v2", domain="http://la.template.local.cc")
     */
    public function testV2(TestRequest $request)
    {
        $params = $request->validated();

        Rt()->message('Just for test');
    }
}
