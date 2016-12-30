import _ from 'lodash';

export default class CrawledUrl
{
    constructor(crawledUrlProperties) {
        this.url = crawledUrlProperties.url;
        this.statusCode = crawledUrlProperties.statusCode;
        this.headers = crawledUrlProperties.headers
        this.title = (this.statusCode == 200 && crawledUrlProperties.headers['X-Guzzle-Redirect-History'] instanceof Object) ? crawledUrlProperties.title : '';
        this.h1 = (this.statusCode == 200 && crawledUrlProperties.headers['X-Guzzle-Redirect-History'] instanceof Object) ? crawledUrlProperties.h1 : '';
        this.foundOnUrl = crawledUrlProperties.foundOnUrl
        this.originalHtml = crawledUrlProperties.originalHtml
        this.updatedHtml = crawledUrlProperties.updatedHtml
        console.log(crawledUrlProperties)
    }

    get contentType() {
        if (this.headers['Content-Type'] == undefined) {
            return '';
        }

        return this.headers['Content-Type'][0] || '';
    }

    isError() {
         if(_.startsWith(this.statusCode, '4') || _.startsWith(this.statusCode, '5')) {
           return true;
         }

         return false;
    }

    isRedirect() {
        if(_.startsWith(this.statusCode, '3') || (_.startsWith(this.statusCode, '2') && this.headers['X-Guzzle-Redirect-History'] instanceof Object)) {
            return true;
        }

       return false;
    }

    hasDomElements() {
        if(this.originalHtml !== null && this.updatedHtml !== null) {
            return 3;
        }
        if(this.originalHtml === null && this.updatedHtml !== null) {
            return 2;
        }
        if(this.originalHtml !== null && this.updatedHtml === null) {
            return 1;
        }

        return 0;
    }

}
