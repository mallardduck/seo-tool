<template>
    <div>
        <input v-model="url" placeholder="https://example.com">
        <button @click="startCrawling">Start crawling</button>
    </div>
</template>

<script>
export default {
    data:  {
        url: ''
    }

    methods: {
        startCrawling()
        {
            this.$store.dispatch('startCrawling', this.url)
        }
    }
}
</script>

