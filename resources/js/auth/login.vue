<template>
    <div>
        <form action="" class="w-50 m-auto card card-body">
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
            <button :disabled="loading" type="submit" class="btn btn-primary btn-lg btn-block" @click.prevent="login">
                <span v-if="loading"><i class="fas fa-spinner fa-spin"></i> Login...</span>
                <span v-else> Login</span>
            </button>
            <hr>
            <div>
                Not have account yet? <span><router-link :to="{name: 'register'}">Register</router-link></span>
            </div>
            <div>
                Forgot password ? <span><router-link :to="{name: 'home'}">Forgot password</router-link></span>
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
    name: "login",
    data() {
        return {
            user:{
                email:null,
                password:null
            }
        }
    },
    computed:{
      ...mapGetters(['userState', 'isLogin'])
    },
    mixins: [error],
    methods:{
       async login(){
            this.loading = true
           try {
               await axios.get('/sanctum/csrf-cookie')
               await axios.post('/login', this.user)
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
