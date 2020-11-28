<?php

declare(strict_types=1);

namespace App\Http\Controllers\Test;

use App\Events\Tested;
use App\Http\Requests\TestRequest;
use Collective\Annotations\Routing\Annotations\Annotations\Get;

trait v2
{
    /**
     * @Get("/v2/test", as="测试接口v2", domain="http://127.0.0.1")
     */
    public function testV2(TestRequest $request)
    {
        $request->validated();

        event(new Tested($request));

        return response()->json([
            'code' => 1000,
            'msg' => 'Just for test',
            'data' => [],
        ]);
    }
}
