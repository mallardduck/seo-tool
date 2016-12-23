<?php

namespace App\Services;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Spatie\Crawler\Url;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class CrawledUrlReport
{
    /** @var \Spatie\Crawler\Url */
    public $url;

    /** @var null|\Psr\Http\Message\ResponseInterface */
    public $response;

    /** @var string */
    public $responseBody = '';

    /** @var null|\Spatie\Crawler\Url */
    public $foundOnUrl;

    public function __construct(Url $url, ?ResponseInterface $response, ?Url $foundOnUrl)
    {
        $this->url = $url;

        $this->response = $response;

        $this->responseBody = (string)$response->getBody();

        $this->foundOnUrl = $foundOnUrl;
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    public function getTitle(): string
    {
        return $this->runDomQuery('head > title');
    }

    public function getH1(): string
    {
        return $this->runDomQuery('H1');
    }

    public function getResponseBodyLength()
    {
        if (is_null($this->response)) {
            return 0;
        }

        return strlen($this->responseBody);
    }

    protected function runDomQuery(string $query)
    {
        try {
            $contents = [];

             (new DomCrawler($this->responseBody ))->filter($query)
                ->each(function (DomCrawler $node) use (&$contents) {
                $contents[] =  $node->text();
            });

             return implode($contents);
        } catch (InvalidArgumentException $e) {
            return '';
        }

    }
}