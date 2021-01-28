<template>
    <div>
        <nav class="navbar navbar-light bg-light p-2 mb-2">
            <router-link :to="{name:'home'}">Home</router-link>
            <router-link :to="{name: 'bookable'}">Bookable</router-link>
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
