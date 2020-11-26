<?php

namespace App\Listeners;

use App\Events\Tested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Test1
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Tested  $event
     * @return void
     */
    public function handle(Tested $event)
    {
        dump($event);
    }
}
