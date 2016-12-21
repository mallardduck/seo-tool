<?php

namespace App\Services;

use League\Fractal\TransformerAbstract;

class CrawledUrlReportTransformer extends TransformerAbstract
{
    public function toArray(CrawledUrlReport $crawledUrlReport): array
    {
        return [
            'statusCode' => $crawledUrlReport->getStatusCode(),
            'url' => $crawledUrlReport->url,
            'title' => $crawledUrlReport->getTitle(),
        ];
    }
}