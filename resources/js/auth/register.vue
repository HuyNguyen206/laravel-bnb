<template>
    <div>
        <form action="" class="w-50 m-auto card card-body">
            <div class="form-group">
                <label for="email">Name</label>
                <input :class="{'is-invalid':errorFor(errors,'name')}" type="text" class="form-control" id="name" v-model="user.name">
                <error-show :list-error="errors" field="name"></error-show>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input :class="{'is-invalid':errorFor(errors,'email')}" type="text" class="form-control" id="email" v-model="user.email">
                <error-show :list-error="errors" field="email"></error-show>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input :class="{'is-invalid':errorFor(errors,'password')}" type="password" class="form-control" id="password" v-model="user.password">
                <error-show :list-error="errors" field="password"></error-show>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input :class="{'is-invalid':errorFor(errors,'password_confirmation')}" type="password" class="form-control" id="password_confirmation" v-model="user.password_confirmation">
                <error-show :list-error="errors" field="password_confirmation"></error-show>
            </div>
            <button :disabled="loading" type="submit" class="btn btn-primary btn-lg btn-block" @click.prevent="register">
                <span v-if="loading"><i class="fas fa-spinner fa-spin"></i> Register...</span>
                <span v-else> Register</span>
            </button>
            <hr>
            <div>
                Switch to login ? <span><router-link :to="{name: 'login'}">Login</router-link></span>
            </div>
        </form>
    </div>
</template>

<script>
import {login} from "./../shared/utils/auth"
import error from "../shared/mixins/error";
import {is422} from "../shared/utils/response"
import {mapGetters} from "vuex"
export default {
    name: "register",
    data() {
        return {
            user:{
                name: null,
                email:null,
                password:null,
                password_confirmation: null
            }
        }
    },
    computed:{
        ...mapGetters(['userState', 'isLogin'])
    },
    mixins: [error],
    methods:{
        async register(){
            this.loading = true
            try {
                await axios.get('/sanctum/csrf-cookie')
                await axios.post('/register', this.user)
                this.errors = []
                login()
                this.$store.dispatch('loadUserInfo')
                this.$router.push({name:'home'})
            }
            catch (err){
                if(is422(err))
                {
                    this.errors = err.response.data.errors
                }
            }
            this.loading = false
        }
    }
}
</script>

<style scoped>

</style>
