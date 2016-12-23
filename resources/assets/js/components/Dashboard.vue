<template>
    <div>
        ik ben dashboard

        <header></header>

        <div v-show="hasActiveUrl">
            <span>Amount of urls crawled: {{ crawlCount }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            crawlCount () {
                return this.$store.state.crawledUrls.length;
            },

            activeUrl() {
                return this.$store.state.activeUrl
            },

            hasActiveUrl() {
                return this.activeUrl != '';
            },
        },
    }
</script>
