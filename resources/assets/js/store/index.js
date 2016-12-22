import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        crawledUrls: [],
    },
    mutations: {
        addCrawledUrl (state, crawledUrl) {
            state.crawledUrls.unshift(crawledUrl);
        }
    }
})