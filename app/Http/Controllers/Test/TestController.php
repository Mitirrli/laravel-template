<?php

namespace App\Http\Controllers\Test;

use App\Http\Controller;
use Collective\Annotations\Routing\Annotations\Annotations\Middleware;

/**
 * @Middleware("throttle:60,1")
 */
class TestController extends Controller
{
    use v2;
    use v3;
}
