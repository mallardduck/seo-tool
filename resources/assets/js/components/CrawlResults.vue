<template>
    <div>

        <crawlControls></crawlControls>

        <div v-show="hasResults">
            <h1>Results for {{ crawlingUrl }}</h1>

            <span>Amount of urls crawled: {{ crawlCount }}</span>

            <table>
                <tr>
                    <td>Status code</td>
                    <td>Url</td>
                    <td>Title</td>
                <tr/>

                <tr v-for="crawledUrl in crawledUrls">
                    <td>{{ crawledUrl.statusCode }}</td>
                    <td>{{ crawledUrl.url }}</td>
                    <td>{{ crawledUrl.title }}</td>
                <tr>

            </table>
        </div>

    </div>
</template>

<script>
    export default {
        computed: {
            crawlingUrl() {
                return this.$store.state.crawlingUrl
            },

            hasResults() {
                return this.crawlingUrl != '';
            },

            crawlCount () {
                return this.$store.state.crawledUrls.length;
            },

            crawledUrls () {
                return this.$store.state.crawledUrls
            },
        },

        methods: {
            increment() {
              this.$store.commit('increment');
            },

        }

    }









</script>
