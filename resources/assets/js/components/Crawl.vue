<template>
    <div>
        <table>
            <tr>
                <thead>
                <th>Url</th>
                <th>Status code</th>
                <tr/>
                </thead>
                <tbody>
                <tr v-for="url in urls">
                    <td>{{ url.url }}</td>
                    <td>{{ url.responseCode }}</td>
                <tr>
                </tbody>

        </table>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                    urls: [
                    ],
                }
        },


        created() {

    window.Echo.channel('crawler').listen('UrlHasBeenCrawled', (e) => {
                this.urls.unshift({ url: e.url, responseCode: e.responseCode});
            });

        }

    }

</script>
