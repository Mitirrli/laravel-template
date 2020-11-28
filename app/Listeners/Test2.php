<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\Tested;

class Test2
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(Tested $event)
    {
        dd(12);
    }
}
