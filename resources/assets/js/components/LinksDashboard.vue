<template>
    <div>
        <h2>Links Dashboard</h2>

        <div v-show="hasActiveUrl">
            <span>Amount of urls crawled: {{ crawlCount }}</span><br />
            <span>Amount of errors: {{ errorCount }}</span><br />
            <span>Amount of redirects: {{ redirectCount }}</span>
        </div>
        <hr />
        <h2>Link Redirects</h2>
        <span>Amount of redirects: {{ redirectCount }}</span>

        <div v-show="hasActiveUrl">


            <table>
                <tr>
                    <td>Status code</td>
                    <td>Found On</td>
                    <td>Url</td>
                    <td>Original HTML</td>
                    <td>Updated HTML</td>
                <tr/>

                <tr v-for="crawledUrl in redirects">
                    <td>{{ crawledUrl.statusCode }}</td>
                    <td>{{ crawledUrl.foundOnUrl }}</td>
                    <td>{{ crawledUrl.url }}</td>
                    <td>{{ crawledUrl.originalHtml }}</td>
                    <td>{{ crawledUrl.updatedHtml }}</td>
                <tr>

            </table>
        </div>

    </div>
</template>

<script>
    export default {
        computed: {
            crawlCount () {
                return this.$store.state.crawledUrls.length;
            },

            errorCount () {
                return this.$store.getters.errors.length;
            },

            redirectCount () {
                return this.$store.getters.redirects.length;
            },

            redirects () {
                return this.$store.getters.redirects;
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
