<?php

namespace App\Console\Commands;

use Spatie\Crawler\Crawler;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;
use App\Services\Crawler\CrawlProfile;
use App\Services\Crawler\CrawlObserver;

class RedirectCrawlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl-redirects {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test redirect crawl';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Crawler::create([
                RequestOptions::CONNECT_TIMEOUT => 10,
                RequestOptions::TIMEOUT => 10,
                RequestOptions::COOKIES => true,
                RequestOptions::ALLOW_REDIRECTS => [
                    'max'             => 10,        // allow at most 10 redirects.
                    'strict'          => true,      // use "strict" RFC compliant redirects.
                    'referer'         => true,      // add a Referer header
                    'track_redirects' => true,
                ],
            ])
            ->setCrawlProfile(new CrawlProfile())
            ->setCrawlObserver(new CrawlObserver())
            ->startCrawling($this->argument('url'));
    }
}
