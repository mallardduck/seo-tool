<?php

namespace App\Events;

use App\Services\CrawledUrlReport;
use App\Services\CrawledUrlReportTransformer;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CrawlHasEnded implements ShouldBroadcast
{
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