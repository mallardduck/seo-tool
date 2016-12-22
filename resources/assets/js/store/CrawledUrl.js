export default class CrawledUrl
{
    constructor(crawledUrlProperties) {
        this.url = crawledUrlProperties.url
        this.title = crawledUrlProperties.title
        this.statusCode = crawledUrlProperties.statusCode
    }
}