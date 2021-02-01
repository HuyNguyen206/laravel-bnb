<template>
    <div style="padding: 1.25rem">
        <h6 class="text-uppercase text-secondary font-weight-bold">Availability</h6>
        <span class="text-success text-uppercase" v-if="hasAvailability">(Available)</span>
        <span class="text-danger text-uppercase" v-if="noAvailability">(No Available)</span>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="from" class="mb-0">From</label>
                    <input @keyup.enter="check" v-model="from" :class="{'is-invalid':errorFor('from')}" type="text" name="from" class="form-control form-control-sm" placeholder="From date" id="from">
                </div>
                <div class="invalid-feedback" v-if="this.hasErrors">
                    <p v-for="(error, index) in errorFor('from')" :key="'from'+index">
                        {{error}}
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="to" class="mb-0">To</label>
                    <input  @keyup.enter="check" v-model="to" :class="{'is-invalid':errorFor('to')}"  type="text" name="to" class="form-control form-control-sm" placeholder="To date" id="to">
                </div>
                <div class="invalid-feedback" v-if="this.hasErrors">
                    <p v-for="(error, index) in errorFor('to')" :key="'to'+index">
                        {{error}}
                    </p>
                </div>
            </div>

        </div>
        <button class="btn btn-secondary btn-block" @click="check" :disabled="loading">Check</button>

    </div>
</template>

<script>
    import {is422} from './../shared/utils/response';
    export default {
        name: "Availability",
        data(){
            return{
                loading: false,
                from: null,
                to:null,
                status:null,
                errors:null
            }
        },
        methods:{
            check(){
                this.loading = true;
                axios.get(`/api/bookables/${this.$route.params.id}/availability/?from=${this.from}&to=${this.to}`)
                .then((response) => {
                    console.log(response)
                    this.errors = null
                    this.status = response.status
                })
                .catch(err => {
                    console.log(err.response)
                    this.status = err.response.status
                    if(is422(err))
                    {
                        this.errors = err.response.data.errors
                    }
                })
                .then(() => {
                    this.loading = false
                })
            },
            errorFor(field){
                return this.hasErrors && this.errors[field] ? this.errors[field] : null
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
