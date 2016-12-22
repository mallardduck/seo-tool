<template>
    <div>

        <crawlStatus></crawlStatus>

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
</template>

<script>
    export default {
        computed: {
            crawlCount () {
                return this.$store.state.crawledUrls.length
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
