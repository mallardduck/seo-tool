export default class CrawledUrl
{
    constructor(crawledUrlProperties) {
        this.url = crawledUrlProperties.url;
        this.title = crawledUrlProperties.title;
        this.statusCode = crawledUrlProperties.statusCode;
        this.h1 = crawledUrlProperties.h1;
        this.headers = crawledUrlProperties.headers
    }


}