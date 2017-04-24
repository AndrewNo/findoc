<template>
    <div class="hero">
        {{ message }}
    </div>
</template>

<script>
    export default {
        data () { /* ES2015 эквивалент для: `data: function () {` */
            return {
                message: 'Hello World!'
            };
        }
    };
</script>

<style>
    .hero {
        background: #eee;
        padding: 1em;
    }
</style>