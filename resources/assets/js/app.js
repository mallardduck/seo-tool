import Echo from 'laravel-echo';
import store from './store';

window.Echo = new Echo({
     broadcaster: 'pusher',
     key: window.pusherKey,
});

Vue.component('CrawlControls', require('./components/CrawlControls.vue'));
Vue.component('CrawlResults', require('./components/CrawlResults.vue'));

const app = new Vue({

    store,

    el: '#app',

    created() {
        window.Echo.channel('crawler').listen('UrlHasBeenCrawled', (event) => {
            this.$store.commit('addCrawledUrl', new CrawledUrl(event.data));
        });

        window.Echo.channel('crawler').listen('CrawlHasEnded', (event) => {
            this.$store.commit('crawlHasEnded');
        });
    },
});
