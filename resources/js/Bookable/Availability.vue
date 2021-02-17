<template>
    <div style="padding: 1.25rem">
        <h6 class="text-uppercase text-secondary font-weight-bold">Check availability
            <transition name="fade">
                <span class="text-success text-uppercase" v-if="hasAvailability">(Available)</span>
                <span class="text-danger text-uppercase" v-if="noAvailability">(No Available)</span>
            </transition>
        </h6>

            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="from" class="mb-0">From</label>
                        <input @keyup.enter="check" v-model="from" :class="{'is-invalid':errorFor(errors,'from')}" type="text" name="from" class="form-control form-control-sm" placeholder="From date" id="from">
                    </div>
                    <error-show :list-error="errors" field="from"></error-show>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="to" class="mb-0">To</label>
                        <input  @keyup.enter="check" v-model="to" :class="{'is-invalid':errorFor(errors,'to')}"  type="text" name="to" class="form-control form-control-sm" placeholder="To date" id="to">
                    </div>
                    <error-show :list-error="errors" field="to"></error-show>
                </div>

            </div>

            <button class="btn btn-secondary btn-block" @click="check" :disabled="loading">
                <i class="fas fa-spinner fa-spin" v-if="loading">Checking...</i>
                <span v-else>Check</span>
            </button>

    </div>
</template>

<script>
    import {is422} from './../shared/utils/response';
    import error from "../shared/mixins/error";
    import {mapActions} from 'vuex'
    export default {
        name: "Availability",
        mixins:[error],
        data(){
            return{
                from: this.$store.state.lastSearch.from,
                to:this.$store.state.lastSearch.to,
                status:null,
            }
        },
        methods:{
            // ...mapActions([
            //     'setLastSearch', // map `this.increment()` to `this.$store.dispatch('increment')`
            // ]),
           async check(){
                console.log(this.$store)
                this.$store.dispatch("setLastSearch",{
                    from: this.from,
                    to:this.to
                })
                this.loading = true;
                try {
                    this.status = (await axios.get(`/api/bookables/${this.$route.params.id}/availability/?from=${this.from}&to=${this.to}`)).status
                }
                catch (err)
                {
                    this.status = err.response.status
                    if(is422(err))
                    {
                        this.errors = err.response.data.errors
                    }
                    else
                        this.errors = []
                }
               this.$emit('availability', {hasAvailability : this.hasAvailability, from :this.from, to: this.to})
               this.loading = false
            }
        },
        computed:{
            hasErrors(){
                return this.status == 422 && this.errors != null
            },
            hasAvailability()
            {
                return this.status == 200
            },
            noAvailability(){
                return this.status == 404
            }

        }
    }
</script>

<style scoped>
.invalid-feedback{
    display: inline-block;
}
</style>
