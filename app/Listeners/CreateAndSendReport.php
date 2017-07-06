<?php

namespace App\Listeners;

use App\Events\CrawlHasEnded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\CrawledUrlReportTransformer;

class CreateAndSendReport implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param  CrawlHasEnded  $event
     * @return void
     */
     //        return fractal($this->crawledUrlReport, new CrawledUrlReportTransformer())->toArray();
    public function handle(CrawlHasEnded $event)
    {
        //
        //$event->redirectCollection = $event->redirectCollection
        //->map(function ($item, $key) {
        //    return fractal($item, new CrawledUrlReportTransformer())->toArray();
        //});
    }
}
