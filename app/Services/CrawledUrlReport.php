<?php

namespace App\Services;

use Spatie\Crawler\Url;
use Spatie\Crawler\CrawlUrl;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class CrawledUrlReport
{
    /** @var \Spatie\Crawler\CrawlUrl */
    protected $url;

    /** @var null|\Psr\Http\Message\ResponseInterface */
    protected $response;

    /** @var string */
    protected $responseBody = '';

    /** @var null|\Spatie\Crawler\Url */
    protected $foundOnUrl;

    /** @var string */
    protected $originalHtml = '';

    /** @var string */
    protected $updatedHtml;

    public function __construct(CrawlUrl $url, $response)
    {
        $this->url = $url;

        $this->response = $response;

        $this->responseBody = $response ? (string) $response->getBody() : '';

        $this->foundOnUrl = $url->foundOnUrl;
        
        if (! is_null($url->node)) {
          $this->originalHtml = $url->node->getHtml();
          
          
          if ($response->hasHeader('X-Guzzle-Redirect-History')) {
            $redirectHeaders = $response->getHeader('X-Guzzle-Redirect-History');
            $finalUrl = end($redirectHeaders);
            
            $this->updatedHtml = $url->node->getHtmlAndUpdateHref($finalUrl);
          }
        }
    }

    public function getUrl(): string
    {
        return (string) $this->url->url;
    }

    public function getFoundOnUrl(): string
    {
        if (! $this->foundOnUrl) {
            return '';
        }

        return (string) $this->foundOnUrl;
    }

    public function getStatusCode()
    {
        if (! $this->response) {
            return null;
        }

        return $this->response->getStatusCode();
    }

    public function getHtml()
    {
        if (! $this->originalHtml) {
            return null;
        }

        return $this->originalHtml;
    }

    public function getNewHtml()
    {
        if (! $this->updatedHtml) {
            return null;
        }

        return $this->updatedHtml;
    }

    public function getTitle(): string
    {
        return $this->runDomQuery('head > title');
    }

    public function getH1(): string
    {
        return $this->runDomQuery('H1');
    }

    public function getHeaders(): array
    {
        if (! $this->response) {
            return [];
        }

        return $this->response->getHeaders();
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

            (new DomCrawler($this->responseBody))->filter($query)
                ->each(function (DomCrawler $node) use (&$contents) {
                    $contents[] = $node->text();
                });

            return implode($contents);
        } catch (InvalidArgumentException $e) {
            return '';
        }
    }
}
