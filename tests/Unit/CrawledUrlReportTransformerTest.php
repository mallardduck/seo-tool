<?php

namespace Tests\Unit;

use App\Services\CrawedUrlReportTransformer;
use PHPUnit_Framework_TestCase;
use Spatie\Crawler\Url;
use GuzzleHttp\Psr7\Response;
use App\Services\CrawledUrlReport;

class CrawledUrlReportTransformerTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_get_transform_a_CrawleUrlReport_to_an_array()
    {
        $url = Url::create('https://example.com');
        $foundOnUrl = Url::create('https://example2.com');

        $headers = ['Content-Type' => ['html/text']];

        $response = new Response(200, ['Content-Type' => ['html/text']], file_get_contents(__DIR__.'/fixtures/default.html'));

        $crawledUrlReport = new CrawledUrlReport($url, $response, $foundOnUrl);

        $transformedReport = (new CrawedUrlReportTransformer())->transform($crawledUrlReport);

        $expectedArray = [
            'url' => 'https://example.com/',
            'statusCode' => 200,
            'title' => 'Page title',
            'headers' => $headers,
            'h1' => 'First h1Second h1',
            'foundOnUrl' => 'https://example2.com/',
        ];

        $this->assertEquals($expectedArray, $transformedReport);
    }
}
