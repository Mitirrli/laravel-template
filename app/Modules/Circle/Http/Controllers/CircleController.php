<?php

namespace App\Modules\Circle\Http\Controllers;

use Illuminate\Routing\Controller;
use Collective\Annotations\Routing\Annotations\Annotations\Get;
use Collective\Annotations\Routing\Annotations\Annotations\Middleware;

/**
 * @Middleware("api")
 */
class CircleController extends Controller
{
    /**
     * @Get("/v4/test", as="测试接口v4")
     */
    public function destroy()
    {
        rt()->message('Just for v4');
    }
}
