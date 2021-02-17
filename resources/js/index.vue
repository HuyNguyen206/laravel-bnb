<template>
    <div>
        <nav class="navbar navbar-light bg-light p-2 mb-2">
            <router-link :to="{name:'home'}">Home</router-link>
            <router-link :to="{name: 'bookable'}">Bookable</router-link>
            <router-link :to="{name : 'home'}" class="btn btn-primary">
                Basket <span class="badge badge-light">{{itemsInBasket}}</span>
            </router-link>
        </nav>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
import {mapState, mapGetters} from 'vuex'
export default {
    name: "index",
    computed:{
        ...mapState({
            lastSearchComputed: 'lastSearch'
        }),
        ...mapGetters({
            itemsInBasket: 'itemsInBasket'
        })
    }

}
</script>

<style scoped>

</style>
