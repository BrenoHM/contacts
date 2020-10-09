<template>
    <div id="app">
        <Principal></Principal>
    </div>
</template>
<script>
    import Principal from './Principal';
    export default {
        name: 'App',
        components: {
            Principal
        }
    };
</script>
<style scoped>
    /* Add scoped styles */
    #app {
        padding: 20px;
    }
</style>
