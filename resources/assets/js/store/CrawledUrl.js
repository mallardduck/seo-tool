import _ from 'lodash';

export default class CrawledUrl
{
    constructor(crawledUrlProperties) {
        this.nodeType = crawledUrlProperties.nodeType;
        this.url = crawledUrlProperties.url;
        this.statusCode = crawledUrlProperties.statusCode;
        this.redirects = crawledUrlProperties.redirectHistory;
        this.headers = crawledUrlProperties.headers;
        this.title = (this.statusCode == 200 && crawledUrlProperties.headers['X-Guzzle-Redirect-History'] instanceof Object) ? crawledUrlProperties.title : '';
        this.h1 = (this.statusCode == 200 && crawledUrlProperties.headers['X-Guzzle-Redirect-History'] instanceof Object) ? crawledUrlProperties.h1 : '';
        this.foundOnUrl = crawledUrlProperties.foundOnUrl;
        this.originalHtml = crawledUrlProperties.originalHtml;
        this.updatedHtml = crawledUrlProperties.updatedHtml;

        this.hasDomElements = domResInt(this);

        function domResInt(thing) {
            if(thing.originalHtml !== null && thing.updatedHtml !== null) {
                return 3;
            }
            if(thing.originalHtml === null && thing.updatedHtml !== null) {
                return 2;
            }
            if(thing.originalHtml !== null && thing.updatedHtml === null) {
                return 1;
            }
            return 0;
        }

    }

    get contentType() {
        if (this.headers['Content-Type'] == undefined) {
            return '';
        }

        return this.headers['Content-Type'][0] || '';
    }

    isImage() {
         if(this.nodeType == "img") {
           return true;
         }

         return false;
    }

    isAnchor() {
         if(this.nodeType == "a") {
           return true;
         }

         return false;
    }

    isError() {
         if(_.startsWith(this.statusCode, '4') || _.startsWith(this.statusCode, '5')) {
           return true;
         }

         return false;
    }

    isRedirect() {
        if(this.redirects instanceof Array) {
            return true;
        }

       return false;
    }

    isSuccess() {
        if(_.startsWith(this.statusCode, '2') && this.redirects === null) {
            return true;
        }

       return false;
    }

}
