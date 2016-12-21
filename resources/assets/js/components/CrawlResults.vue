<template>
    <div>

        <crawlStatus></crawlStatus>

        <table>
            <tr>
                <thead>
                    <th>Status code</th>
                    <th>Url</th>
                    <th>Title</th>
                <tr/>
                </thead>
                    <tbody>
                        <tr v-for="url in urls">
                            <td>{{ url.statusCode }}</td>
                            <td>{{ url.url }}</td>
                            <td>{{ url.title }}</td>
                        <tr>
                </tbody>

        </table>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                    urls: [
                    ],
                }
        },

        created() {

            window.Echo.channel('crawler').listen('UrlHasBeenCrawled', (e) => {
                this.urls.unshift({
                    url: e.url,
                    responseCode: e.responseCode,
                    title: e.title,
                });
            });

        }

    }

</script>
