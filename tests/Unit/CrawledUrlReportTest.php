<?php

namespace Tests\Unit;

use App\Services\CrawledUrlReport;

use GuzzleHttp\Psr7\Response;
use Spatie\Crawler\Url;

class CrawlUrlReportTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_get_properties_of_a_successful_response()
    {
        $url = Url::create('https://example.com');
        $foundOnUrl = Url::create('https://example2.com');

        $headers = ['Content-Type' => ['html/text']];

        $response = new Response(200, ['Content-Type' => ['html/text']], file_get_contents(__DIR__ . '/fixtures/default.html'));

        $crawledUrlReport = new CrawledUrlReport($url, $response, $foundOnUrl);

        $this->assertEquals('https://example.com/', $crawledUrlReport->getUrl());
        $this->assertEquals(200, $crawledUrlReport->getStatusCode());
        $this->assertEquals('Page title', $crawledUrlReport->getTitle());
        $this->assertEquals($headers, $crawledUrlReport->getHeaders());
        $this->assertEquals(170, $crawledUrlReport->getResponseBodyLength());
        $this->assertEquals('First h1Second h1', $crawledUrlReport->getH1());
        $this->assertEquals('https://example2.com/', $crawledUrlReport->getFoundOnUrl());
    }

    /** @test */
    public function it_can_get_properties_of_a_failed_response()
    {
        $url = Url::create('https://example.com');

        $crawledUrlReport = new CrawledUrlReport($url, null);

        $this->assertEquals('https://example.com/', $crawledUrlReport->getUrl());
        $this->assertNull($crawledUrlReport->getStatusCode());
        $this->assertEquals('', $crawledUrlReport->getTitle());
        $this->assertEquals([], $crawledUrlReport->getHeaders());
        $this->assertEquals(0, $crawledUrlReport->getResponseBodyLength());
        $this->assertEquals('', $crawledUrlReport->getH1());
        $this->assertEquals('', $crawledUrlReport->getFoundOnUrl());
    }
}