<template>
    <div>
        <success v-if="alreadyPurchase">Congratulation on your purchase!</success>
        <div v-else class="row">
                <div class="col-md-8" v-if="itemsInBasket">
                    <form action="">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="fist_name">First Name</label>
                                    <input :class="{'is-invalid':errorFor(errors,'customer.first_name')}" v-model="customer.first_name" type="text" class="form-control" id="fist_name">
                                    <error-show :list-error="errors" field="customer.first_name"></error-show>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="last_name">Last Name</label>
                                    <input :class="{'is-invalid':errorFor(errors,'customer.last_name')}" v-model="customer.last_name" type="text" class="form-control" id="last_name">
                                    <error-show :list-error="errors" field="customer.last_name"></error-show>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="from-group">
                                    <label for="email">Email</label>
                                    <input :class="{'is-invalid':errorFor(errors,'customer.email')}"   v-model="customer.email" type="email" id="email" class="form-control">
                                      <error-show :list-error="errors" field="customer.email"></error-show>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="street">Street</label>
                                    <input :class="{'is-invalid':errorFor(errors,'customer.street')}"  v-model="customer.street" type="text" class="form-control" id="street">
                                      <error-show :list-error="errors" field="customer.street"></error-show>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="city">City</label>
                                    <input :class="{'is-invalid':errorFor(errors,'customer.city')}"  v-model="customer.city" type="text" class="form-control" id="city">
                                      <error-show :list-error="errors" field="customer.city"></error-show>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="country">Country</label>
                                    <input :class="{'is-invalid':errorFor(errors,'customer.country')}"  type="text" v-model="customer.country" class="form-control" id="country">
                                      <error-show :list-error="errors" field="customer.country"></error-show>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="from-group">
                                    <label for="state">State</label>
                                    <input :class="{'is-invalid':errorFor(errors,'customer.state')}"  type="text" v-model="customer.state" class="form-control" id="state">
                                      <error-show :list-error="errors" field="customer.state"></error-show>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="from-group">
                                    <label for="zip">Zip</label>
                                    <input :class="{'is-invalid':errorFor(errors,'customer.zip')}"  type="text" v-model="customer.zip" class="form-control" id="zip">
                                      <error-show :list-error="errors" field="customer.zip"></error-show>
                                </div>
                            </div>
                        </div>
                        <button :disabled="loading" type="submit" class="btn btn-primary btn-lg btn-block" @click.prevent="book()">
                            <span v-if="loading"><i class="fas fa-spinner fa-spin"></i> Booking...</span>
                            <span v-else>  Book now!</span>
                        </button>
                    </form>
                </div>
                <div class="col-md-8" v-else>
                    <div class="jumbotron jumbotron-fluid text-center">
                        <h1>Empty</h1>
                    </div>
                </div>
            <div class="col-md-4">
                <div class="row cart">
                    <div class="col-md-11">
                        Your cart
                        <hr>
                        <transition-group tag="div" class="transition-group">
                            <div v-for="(item, index) in basket.items" :key="item.bookable.id">
                                <div class="d-flex justify-content-between mb-2">
                                    <router-link :to="{name: 'bookable', params:{id: item.bookable.id}}">
                                        {{ item.bookable.title }}
                                    </router-link>
                                    <span>${{ item.priceBooking.price }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>From {{ item.lastSearch.from }}</span>
                                    <span>To {{ item.lastSearch.to }}</span>
                                </div>
                                <div>
                                    <span class="fas fa-trash-alt" style="cursor: pointer"
                                          @click="$store.commit('removeFromBasket', item.bookable.id)"></span>
                                </div>
                                <error-show :list-error="errors" :field="`bookings.${index}`"></error-show>
                                <hr>
                            </div>
                        </transition-group>

                    </div>
                    <div class="col-md-1">
                        <h6 v-if="itemsInBasket" class="badge badge-secondary font-weight-bolder text-uppercase">Items:
                            {{ itemsInBasket }}</h6>
                        <h6 v-else class="badge badge-secondary font-weight-bolder text-uppercase">Empty</h6>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex';
import error from "../shared/mixins/error";
export default {
    name: "basket",
    mixins: [error],
    computed: {
        ...mapGetters(['itemsInBasket', 'basket'])
    },
    data() {
        return {
            customer:{
                first_name:null,
                last_name:null,
                email:null,
                street:null,
                city:null,
                country:null,
                state:null,
            },
            alreadyPurchase:false
        }
    },
    methods:{
         book(){
             this.alreadyPurchase = false
            let bookings =  this.basket.items.map((item) => {
                let booking = {
                    bookables_id: item.bookable.id,
                    from: item.lastSearch.from,
                    to: item.lastSearch.to
                }
                return booking
            });
            let data = {
                bookings,
                customer: this.customer
            }
            this.loading = true
            axios.post('/api/checkout', data)
             .then(res => {
                 this.$store.dispatch('setBasket', [])
                 this.errors = []
                 this.alreadyPurchase = true
             })
             .catch(err => {
                this.errors = err.response.data.errors
             })
             .then(data => {
                 this.loading = false
             })
        }
    }
}
</script>

<style scoped>
.cart h6 {
    font-size: 100%;
}
</style>
