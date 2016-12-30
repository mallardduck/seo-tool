<?php

namespace App\Services\Crawler;

use Spatie\Crawler\CrawlUrl;
use App\Events\CrawlHasEnded;
use App\Events\UrlHasBeenCrawled;
use App\Services\CrawledUrlReport;

class CrawlObserver implements \Spatie\Crawler\CrawlObserver
{
    /**
     * Called when the crawler will crawl the url.
     *
     * @param \Spatie\Crawler\CrawlUrl $url
     *
     * @return void
     */
    public function willCrawl(CrawlUrl $url)
    {
    }

    /**
     * Called when the crawler has crawled the given url.
     *
     * @param \Spatie\Crawler\CrawlUrl $url
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return void
     */
    public function hasBeenCrawled(CrawlUrl $url, $response)
    {
        $crawledUrlReport = new CrawledUrlReport($url, $response);

        event(new UrlHasBeenCrawled($crawledUrlReport));
    }

    /**
     * Called when the crawl has ended.
     *
     * @return void
     */
    public function finishedCrawling()
    {
        \Log::info('crawl has ended');

        event(new CrawlHasEnded());
    }
}
