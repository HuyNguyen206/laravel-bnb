<template>
    <div>
        <nav class="navbar navbar-light bg-light p-2 mb-2 align-items-start">
            <router-link :to="{name:'home'}">Home</router-link>
            <ul class="navbar-nav" >
                <li class="nav-item" v-if="isLogin">
                    <router-link :to="{name : 'basket'}"  class="nav-link">
                        Basket <span class="badge badge-light">{{itemsInBasket}}</span>
                    </router-link>
                </li>
                <li class="nav-item" v-if="!isLogin">
                    <router-link :to="{name : 'home'}" class="nav-link">
                        Login
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name : 'home'}" v-if="!isLogin" class="nav-link">
                        Register
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name : 'home'}" v-if="isLogin"class="nav-link">
                        Logout
                    </router-link>
                </li>
            </ul>
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
            itemsInBasket: 'itemsInBasket',
            isLogin: 'isLogin'
        })
    }

}
</script>

<style scoped>

</style>
