<template>
    <div>
        <h3>Redirects</h3>
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
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="crawledUrl in redirects">
                        <td><redirects-link v-bind:history="crawledUrl.redirects" >{{ crawledUrl.redirects.length }}</redirects-link></td>
                        <td>{{ crawledUrl.statusCode }}</td>
                        <td>{{ crawledUrl.foundOnUrl }}</td>
                        <td>{{ crawledUrl.url }}</td>
                        <td>{{ crawledUrl.originalHtml }}</td>
                    </tr>
                </tbody>
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

            redirectCount () {
            return this.$store.getters.redirects.length;
            },
            
            hasActiveUrl() {
            return this.activeUrl != '';
            },

            redirects () {
                return this.$store.getters.redirects;
            },


        },
    }
</script>
