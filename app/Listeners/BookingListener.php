<?php

namespace App\Listeners;

use App\Events\BookingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingListener
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
     * @param  BookingEvent  $event
     * @return void
     */
    public function handle(BookingEvent $event)
    {
        echo('updating');
    }
}
