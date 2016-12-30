<template>
    <div>
        <div v-show="crawlerIsNotBusy">
            <input v-model="url" placeholder="https://example.com">
            <select v-model="crawlType">
              <option v-for="item in crawlOptions" :value="item.value" v-text="item.text"></option>
            </select>
            <button @click="startCrawling">Start crawling</button>
        </div>

        <div>CrawlStatus: {{ crawlStatus }}</div>
        <div>CrawlType: {{ crawlType }}</div>

        <ul>
            <li><router-link to="/">Dashboard</router-link></li>
            <li><router-link to="/errors">Non 2xx responses</router-link></li>
            <li><router-link to="/all">All crawled links</router-link></li>
            <li><router-link to="/links">links Dashboard</router-link></li>
        </ul>

        <h1 v-show="hasActiveUrl">Seo report for {{ activeUrl }}</h1>
    </div>
</template>

<script>
export default {
    computed: {
        crawlerIsNotBusy()  {
        return true;

           return this.$store.state.crawlStatus != 'busy';
        },

        crawlStatus() {
           return this.$store.state.crawlStatus
        },

        hasActiveUrl() {
           return this.activeUrl != '';
        },

        activeUrl() {
           return this.$store.state.activeUrl;
        },
    },

    data: function () {
      return {
        crawlType: 'default',
        crawlOptions: [{
          value: 'default',
          text: 'Default'
        },{
          value: 'redirect',
          text: 'Redirects'
        }]
      }
    },

    methods: {
        startCrawling() {
            this.$store.dispatch('startCrawling', {'url': this.url, 'crawlType': this.crawlType})
        },
    }
}

</script>
