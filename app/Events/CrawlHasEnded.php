<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CrawlHasEnded implements ShouldBroadcast
{
    /** @var \Illuminate\Support\Collection */
    public $redirectCollection;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($redirectCollection)
    {
        //
        $this->redirectCollection = $redirectCollection;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['crawler'];
    }
}
