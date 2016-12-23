<?php

namespace App\Services;

use League\Fractal\TransformerAbstract;

class CrawledUrlReportTransformer extends TransformerAbstract
{
    public function transform(CrawledUrlReport $crawledUrlReport): array
    {
        return [
            'statusCode' => $crawledUrlReport->getStatusCode(),
            'url' => (string)$crawledUrlReport->url,
            'title' => $crawledUrlReport->getTitle(),
            'h1' => $crawledUrlReport->getH1(),
        ];
    }
}