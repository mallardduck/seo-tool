<?php

namespace App\Console\Commands;

use App\Services\Crawler\CrawlObserver;
use Illuminate\Console\Command;
use Spatie\Crawler\Crawler;

class CrawlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test crawl';

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
        $crawler = Crawler::create()
            ->setCrawlObserver(new CrawlObserver())
            ->startCrawling('https://spatie.be');
    }
}
