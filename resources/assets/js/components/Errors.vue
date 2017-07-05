<template>
    <div>
        <h2>Non 2xx responses</h2>
        <span>Amount of errors: {{ errors.length }}</span>

        <div v-show="hasActiveUrl">


            <table>
                <tr>
                    <td>Status code</td>
                    <td>Url</td>
                    <th>Found On</th>
                </tr>

                <tr v-for="crawledUrl in errors">
                    <td>{{ crawledUrl.statusCode }}</td>
                    <td>{{ crawledUrl.url }}</td>
                    <td>{{ crawledUrl.foundOnUrl }}</td>
                </tr>

            </table>
        </div>

    </div>
</template>

<script>
    export default {
        computed: {
            errors () {
                return this.$store.getters.errors;
            },

            hasActiveUrl() {
                return this.activeUrl != '';
            },
        },
    }
</script>
