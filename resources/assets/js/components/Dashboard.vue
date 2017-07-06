<template>
    <div>
        <h2>Dashboard</h2>

        <div v-show="hasActiveUrl">
            <span>Amount of urls crawled: {{ crawlCount }}</span><br />
            <span>Amount of successes: {{ successCount }}</span><br />
            <span>Amount of redirects: {{ redirectCount }}</span><br />
            <span>Amount of errors: {{ errorCount }}</span><br />
        </div>
        <hr />
        <links-dashboard v-show="!crawlerIsIdle" v-if="hasRedirects"></links-dashboard>

        <errors v-show="!crawlerIsIdle" v-if="hasErrors"></errors>

        <span v-show="crawlerIsIdle">Crawler is Idle, to begin scan enter domain above and click 'Start crawling'.</span>

    </div>
</template>

<script>
    export default {
        computed: {
            activeUrl() {
                return this.$store.state.activeUrl
            },

            hasActiveUrl() {
                return this.activeUrl != '';
            },

            crawlCount () {
            return this.$store.state.crawledUrls.length;
            },
            
            successCount () {
            return this.$store.getters.successes.length;
            },
            
            redirectCount () {
            return this.$store.getters.redirects.length;
            },

            hasRedirects() {
                return (this.$store.getters.redirects.length >= 1);
            },

            errorCount () {
            return this.$store.getters.errors.length;
            },

            hasErrors() {
                return (this.$store.getters.errors.length >= 1);
            },

            crawlerIsIdle()  {
               return this.$store.state.crawlStatus == 'idle';
            },
        },
    }
</script>
