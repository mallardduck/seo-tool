<template>
    <div v-show="crawlerIsNotBusy">
        <input v-model="url" placeholder="https://example.com">
        <button @click="startCrawling">Start crawling</button>
    </div>
</template>

<script>
export default {
    computed: {
        crawlerIsNotBusy()  {
           return this.$store.state.crawlStatus != 'busy';
        }
    },

    methods: {
        startCrawling()
        {
            this.$store.dispatch('startCrawling', this.url)
        }
    }
}
</script>

