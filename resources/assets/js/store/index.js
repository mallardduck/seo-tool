import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        crawledUrls: [],
        crawlingUrl: '',
        crawlStatus: 'idle',
    },

    mutations: {
        startCrawling(state, url) {
            state.crawledUrls = [];
            state.crawlingUrl = url;
            state.crawlStatus = 'busy';
        },

        addCrawledUrl (state, crawledUrl) {
            state.crawledUrls.unshift(crawledUrl);
        },

        crawlHasEnded(state) {
            state.crawlStatus = 'finished';
        }
    },

    actions: {
        startCrawling(context, url) {
            axios.post('/api/crawl/start', {url})
                .then(function() {console.log('hier'); context.commit('startCrawling', url)
            })
        }
    }
})