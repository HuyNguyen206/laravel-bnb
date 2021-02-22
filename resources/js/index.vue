<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-2 mb-2 align-items-start justify-content-between">
            <router-link class="navbar-brand" :to="{name:'home'}">Home</router-link>
            <ul class="navbar-nav">
                <li class="nav-item" v-if="isLogin">
                    <router-link :to="{name : 'basket'}"  class="nav-link">
                        Basket <span class="badge badge-light">{{itemsInBasket}}</span>
                    </router-link>
                </li>
                <li class="nav-item" v-if="!isLogin">
                    <router-link :to="{name : 'login'}" class="nav-link">
                        Login
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name : 'register'}" v-if="!isLogin" class="nav-link">
                        Register
                    </router-link>
                </li>
                <li class="nav-item">
                    <a v-if="isLogin" href="" class="nav-link" @click.prevent="logoutUser">
                        Logout
                    </a>
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
    },
    methods:{
        async logoutUser(){
            try{
                await axios.post('/logout')
                this.$store.dispatch('logout')
                this.$router.push({name: 'login'})
            }
            catch (err)
            {
                this.$store.dispatch('logout')
            }

        }
    }

}
</script>

<style scoped>

</style>
