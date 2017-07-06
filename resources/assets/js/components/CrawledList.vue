<template>
    <div>
        <h3>All crawled urls</h3>

        <span>Amount of urls crawled: {{ crawlCount }}</span>

        <div v-show="hasActiveUrl">
            <table>
                <tr>
                    <td>Status code</td>
                    <td>Url</td>
                    <td>Content type</td>
                </tr>

                <tr v-for="crawledUrl in crawledUrls">
                    <td>{{ crawledUrl.statusCode }}</td>
                    <td>{{ crawledUrl.url }}</td>
                    <td>{{ crawledUrl.contentType }}</td>
                </tr>

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
            
            crawledUrls () {
            return this.$store.state.crawledUrls;
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
