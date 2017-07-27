<?php

namespace App\Services;

use Spatie\Crawler\CrawlUrl;
use InvalidArgumentException;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class CrawledUrlReport
{
    /** @var \Spatie\Crawler\CrawlUrl */
    protected $url;

    /** @var null|\Psr\Http\Message\ResponseInterface */
    protected $response;

    /** @var string */
    protected $responseBody = '';

    /** @var \Illuminate\Support\Collection */
    protected $redirectHistory;

    /** @var null|\Spatie\Crawler\Url */
    protected $foundOnUrl;

    /** @var string */
    protected $nodeType;

    /** @var string */
    protected $originalHtml = '';

    /** @var string */
    protected $updatedHtml;

    /** @var bool */
    protected $urlRedirects = false;

    /**
     * @param \Spatie\Crawler\CrawlUrl  $url
     * @param \Psr\Http\Message\ResponseInterface|null             $response
     *
     * @return void
     */
    public function __construct(CrawlUrl $url, $response)
    {
        $this->url = $url;

        $this->foundOnUrl = $url->foundOnUrl;

        $this->response = $response;

        if (! is_null($url->node)) {
            $this->originalHtml = $url->node->getHtml();
            $this->nodeType = $url->node->getNodeType();
        }

        if (! is_null($response) && $response->hasHeader('X-Guzzle-Redirect-History')) {
            $this->urlRedirects = true;
            $this->responseBody = $response ? (string) $response->getBody() : '';

            $firstUrl = (string) $this->url->url;
            $redirectHistory = collect($response->getHeader('X-Guzzle-Redirect-History'))->reverse()->push((string) $this->url->url)->reverse()->values();
            $redirectStatusHistory = collect($response->getHeader('X-Guzzle-Redirect-Status-History'))
                                ->map(function ($item, $key) {
                                    return (int) $item;
                                })
                                ->push((int) $response->getStatusCode());
            $finalUrl = $redirectHistory->last();

            $this->redirectHistory = $redirectHistory->map(function ($item, $key) use ($redirectStatusHistory) {
                return ['location' => $item, 'code' => $redirectStatusHistory[$key]];
            });
        }
    }

    public function isRedirect(): bool
    {
        return $this->urlRedirects;
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

    public function getNodeType(): string
    {
        if (! $this->nodeType) {
            return '';
        }

        return (string) $this->nodeType;
    }

    public function getStatusCode()
    {
        if (! $this->response) {
            return null;
        }

        return $this->response->getStatusCode();
    }

    public function getRedirectHistory()
    {
        if (! $this->redirectHistory) {
            return null;
        }

        return $this->redirectHistory;
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
