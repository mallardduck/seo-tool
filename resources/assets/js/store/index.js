import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        crawledUrls: [],
        crawlingUrl: '',
        crawlStatus: '',
    },

    mutations: {
        addCrawledUrl (state, crawledUrl) {
            state.crawledUrls.unshift(crawledUrl);
        }
    },

    actions: {
        startCrawling(state, url) {

        }
    }
})