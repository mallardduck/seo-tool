<?php

namespace App\Services;

use Psr\Http\Message\ResponseInterface;
use Spatie\Crawler\Url;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class CrawledUrlReport
{
    /** @var \Spatie\Crawler\Url */
    public $url;

    /** @var null|\Psr\Http\Message\ResponseInterface */
    public $response;

    /** @var null|\Spatie\Crawler\Url */
    public $foundOnUrl;

    /** @var \Symfony\Component\DomCrawler\Crawler */
    protected $dom;

    public function __construct(Url $url, ?ResponseInterface $response, ?Url $foundOnUrl)
    {
        $this->url = $url;

        $this->response = $response;

        $this->foundOnUrl = $foundOnUrl;

        $this->dom = new DomCrawler((string)$response->getBody());
    }

    public function getStatusCode()
    {
        $this->response->getStatusCode();
    }

    public function getTitle(): string
    {
        return $this->response ? $this->dom->filter('head > title')->html() : '';
    }
}