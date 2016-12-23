export default class CrawledUrl
{
    constructor(crawledUrlProperties) {
        this.url = crawledUrlProperties.url;
        this.statusCode = crawledUrlProperties.statusCode;
        this.title = this.statusCode == 200 ? crawledUrlProperties.title : '';
        this.h1 = this.statusCode == 200 ? crawledUrlProperties.h1 : '';
        this.headers = crawledUrlProperties.headers
    }

    get contentType() {
        return this.headers['Content-Type'][0] || '';
    }


}