<template>
    <div class="container">
        <router-link to="/">Home</router-link>
        <router-link to="/second">Second</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "index"
}
</script>

<style scoped>

</style>
