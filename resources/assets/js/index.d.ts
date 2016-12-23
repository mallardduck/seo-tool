interface CrawledUrl {
    url: string;
    title: string;
    statusCode: number;
}

type CrawlStatus = 'idle' | 'busy' | 'finished';