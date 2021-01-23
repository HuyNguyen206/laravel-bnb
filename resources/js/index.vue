<template>
    <div>
        <nav class="navbar navbar-light bg-light p-2 mb-2">
            <router-link to="/">Home</router-link>
            <router-link to="/second">Second</router-link>
        </nav>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
export default {
    name: "index"
}
</script>

<style scoped>

</style>
