<?php

namespace App\Services\Crawler;

use Spatie\Crawler\Url;

class CrawlProfile implements \Spatie\Crawler\CrawlProfile
{
    public function shouldCrawl(Url $url): bool
    {
      if (ends_with($url->path, ['.pdf']) || str_contains($url, ['/blog/', '/kb/', '/anchor/', '/storm/api', '/manage/'])) {
        return false;
      }
      if (str_contains($url->host, [
          'grandmascookieblog.com',
          'new.staging.liquidweb.com',
          'new.liquidweb.dev',
          'new.liquidweb.com',
          'liquidweb.com',
          'www-staging-liquidweb-com.s3.us-east-2.amazonaws.com',
          'www-staging-liquidweb-com.s3.amazonaws.com',
        ])) {
        return true;
      }
      return false;
    }
}

function starts_with($haystack, $needles)
{
    foreach ((array) $needles as $needle) {
        if ($needle != '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
            return true;
        }
    }
    return false;
}

function str_contains($haystack, $needles)
{
    foreach ((array) $needles as $needle)
    {
        if ($needle != '' && strpos($haystack, $needle) !== false) return true;
    }
    return false;
}

function ends_with($haystack, $needles)
{
    foreach ((array) $needles as $needle)
    {
        if ((string) $needle === substr($haystack, -strlen($needle))) return true;
    }
    return false;
}
