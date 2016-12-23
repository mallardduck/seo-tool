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

    /** @var string */
    public $responseBody = '';

    /** @var null|\Spatie\Crawler\Url */
    public $foundOnUrl;

    /** @var \Symfony\Component\DomCrawler\Crawler */
    protected $dom;

    public function __construct(Url $url, ?ResponseInterface $response, ?Url $foundOnUrl)
    {
        $this->url = $url;

        $this->response = $response;

        $this->responseBody = (string)$response->getBody();

        $this->foundOnUrl = $foundOnUrl;
    $this->responseBody = '<!doctype html>
<html>
<head>
    <title>Example Domain</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
    body {
        background-color: #f0f0f2;
        margin: 0;
        padding: 0;
        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
        
    }
    div {
        width: 600px;
        margin: 5em auto;
        padding: 50px;
        background-color: #fff;
        border-radius: 1em;
    }
    a:link, a:visited {
        color: #38488f;
        text-decoration: none;
    }
    @media (max-width: 700px) {
        body {
            background-color: #fff;
        }
        div {
            width: auto;
            margin: 0 auto;
            border-radius: 0;
            padding: 1em;
        }
    }
    </style>    
</head>

<body>
<div>
    <h1>Example Domain</h1>
    <p>This domain is established to be used for illustrative examples in documents. You may use this
    domain in examples without prior coordination or asking for permission.</p>
    <p><a href="http://www.iana.org/domains/example">More information...</a></p>
</div>
</body>
</html>
';
        $this->dom = new DomCrawler($this->responseBody);
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    public function getTitle(): string
    {
        if (strlen($this->responseBody) === 0) {
            echo 'no title';
            return '';
        }

        return $this->dom->filter('head > title')->html();
    }

    public function getResponseBodyLength()
    {
        if (is_null($this->response)) {
            return 0;
        }

        return strlen($this->responseBody);
    }


}