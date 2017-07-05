<template>
    <span>
    <button type="button" class="btn btn-default" v-bind:title="tooltipText">
        <slot></slot>
    </button>
    </span>
</template>

<script>
    export default {
        props: ['history'],
        computed: {
            tooltipText: function () {
                var text = "\n";
                for (var i = 0, len = this.history.length; i < len; i++) {
                  text += "Redirect Status: "+this.history[i].code+" on page: "+this.history[i].location+"\n";
                }
                return text;
            }
        }
    }
</script>
