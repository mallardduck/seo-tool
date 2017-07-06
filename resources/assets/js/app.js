
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store/index';
import CrawledUrl from './store/CrawledUrl';
import VueRouter from 'vue-router'

import Errors from './components/Errors.vue';
import CrawledList from './components/CrawledList.vue';
import Dashboard from './components/Dashboard.vue';
import LinksDashboard from './components/LinksDashboard.vue';
import AppHeader from './components/AppHeader.vue';
import RedirectsLink from './components/RedirectsLink.vue';
import PageNotFound from './components/PageNotFound.vue';

Vue.component('CrawledList', CrawledList);
Vue.component('Errors', Errors);
Vue.component('Dashboard', Dashboard);
Vue.component('LinksDashboard', LinksDashboard);
Vue.component('AppHeader', AppHeader);
Vue.component('RedirectsLink', RedirectsLink);
Vue.component('PageNotFound', PageNotFound);

Vue.use(VueRouter)


var verifyCrawlerState = (to, from, next) => {
    // ...
    if (store.state.activeUrl == "") {
      next({
        path: '/',
      })
    }
    next() // make sure to always call next()!
}

const routes = [
    { path: '/', component: Dashboard },
    { path: '/errors', component: Errors, beforeEnter: verifyCrawlerState },
    { path: '/redirects', component: LinksDashboard, beforeEnter: verifyCrawlerState },
    { path: '/all', component: CrawledList, beforeEnter: verifyCrawlerState },
    { path: '*', component: PageNotFound}, // Catch all for 404s
]

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    router,
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
    
    computed: {
        activeUrl() {
            return this.$store.state.activeUrl
        },

        hasActiveUrl() {
            return this.activeUrl != '';
        },
      }
});
