<template>
    <div>
        <div v-show="hasActiveUrl">
            <span>Amount of urls crawled: {{ crawlCount }}</span>

            <table>
                <tr>
                    <td>Status code</td>
                    <td>Url</td>
                    <td>Title</td>
                    <td>H1</td>
                <tr/>

                <tr v-for="crawledUrl in crawledUrls">
                    <td>{{ crawledUrl.statusCode }}</td>
                    <td>{{ crawledUrl.url }}</td>
                    <td>{{ crawledUrl.title }}</td>
                    <td>{{ crawledUrl.h1 }}</td>
                <tr>

            </table>
        </div>

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
