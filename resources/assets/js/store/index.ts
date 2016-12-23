import * as Vue from 'vue';
import * as Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

interface State {
    crawledUrls: CrawledUrl[];
    crawlingUrl: string;
    crawlStatus: CrawlStatus;
}

const state: State = {
    crawledUrls: [],
    crawlingUrl: '',
    crawlStatus: 'idle',
};

const mutations = {
    startCrawling(state: State, { url }: { url: string }) {
        state.crawledUrls = [];
        state.crawlingUrl = url;
        state.crawlStatus = 'busy';
    },

    addCrawledUrl (state: State, { crawledUrl }: { crawledUrl: CrawledUrl }) {
        state.crawledUrls.unshift(crawledUrl);
    },

    crawlHasEnded(state: State) {
        state.crawlStatus = 'finished';
    },
};

type Context = Vuex.ActionContext<State, State>;

const actions = {
    startCrawling({ commit }: Context, { url }: { url: string }) {
        axios
            .post('/api/crawl/start', {url})
            .then(() => commit('startCrawling', { url }));
    },
};

export default new Vuex.Store({ state, mutations, actions });
