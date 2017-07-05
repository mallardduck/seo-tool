import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        crawledUrls: [],
        crawledAnchors: [],
        crawledImages: [],
        activeUrl: '',
        crawlStatus: 'idle',
        crawlType: 'default',
    },

    getters: {
        successes: state => {
            return state.crawledUrls.filter(crawledUrl => crawledUrl.isSuccess())
        },
        errors: state => {
            return state.crawledUrls.filter(crawledUrl => crawledUrl.isError())
        },
        redirects: state => {
            return state.crawledUrls.filter(crawledUrl => crawledUrl.isRedirect())
        },
    },

    mutations: {
        startCrawling(state, url, type) {
            state.crawledUrls = [];
            state.crawledAnchors = [];
            state.crawledImages = [];
            state.activeUrl = url;
            state.crawlStatus = 'busy';
            state.crawlType = type;
        },

        addCrawledUrl (state, crawledUrl) {
            state.crawledUrls.unshift(crawledUrl);
            if (crawledUrl.isAnchor()) {
              state.crawledAnchors.unshift(crawledUrl);
            }
            if (crawledUrl.isImage()) {
              state.crawledImages.unshift(crawledUrl);
            }
        },

        crawlHasEnded(state) {
            state.crawlStatus = 'finished';
        }
    },

    actions: {
        startCrawling(context, opts) {
            var url = opts.url;
            if (opts.crawlType === 'redirect'){
              axios.post('/api/crawl/startRedirect', {url})
                  .then(() => context.commit('startCrawling', url));
            } else {
              axios.post('/api/crawl/start', {url})
              .then(() => context.commit('startCrawling', url));
            }
        }
    }
})
