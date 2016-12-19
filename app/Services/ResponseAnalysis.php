<?php

namespace App\Services;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

class ResponseAnalysis
{
    /** @var \Symfony\Component\DomCrawler\Crawler */
    protected $dom;

    public function __construct(ResponseInterface $response)
    {
        $this->dom = new Crawler((string)$response->getBody());
    }

    public function getTitle(): string
    {
        return $this->dom->filter('head > title')->html();
    }
}