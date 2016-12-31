<template>
    <div>
        <h2>Links Dashboard</h2>

        <div v-show="hasActiveUrl">
            <span>Amount of urls crawled: {{ crawlCount }}</span><br />
            <span>Amount of successes: {{ successCount }}</span><br />
            <span>Amount of redirects: {{ redirectCount }}</span><br />
            <span>Amount of errors: {{ errorCount }}</span><br />
        </div>
        <hr />
        <h2>Link Redirects</h2>
        <span>Amount of redirects: {{ redirectCount }}</span>

        <div class="table-responsive" v-show="hasActiveUrl">


            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Redirect Count</th>
                        <th>Status code</th>
                        <th>Found On</th>
                        <th>Url</th>
                        <th>Original HTML</th>
                        <th>Updated HTML</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="crawledUrl in redirects">
                        <td><redirects-link v-bind:history="crawledUrl.redirects" >{{ crawledUrl.redirects.length }}</redirects-link></td>
                        <td>{{ crawledUrl.statusCode }}</td>
                        <td>{{ crawledUrl.foundOnUrl }}</td>
                        <td>{{ crawledUrl.url }}</td>
                        <td>{{ crawledUrl.originalHtml }}</td>
                        <td>{{ crawledUrl.updatedHtml }}</td>
                    <tr>
                <tbody>
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

            successCount () {
                return this.$store.getters.successes.length;
            },

            redirectCount () {
                return this.$store.getters.redirects.length;
            },

            errorCount () {
                return this.$store.getters.errors.length;
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
