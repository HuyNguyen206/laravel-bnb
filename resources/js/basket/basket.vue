<template>
<div>
    <div class="row">
        <div class="col-md-8">
            <form action="">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="from-group">
                            <label for="fist_name">First Name</label>
                            <input type="text" class="form-control" id="fist_name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="from-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name">
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="from-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="from-group">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="from-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city">
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="from-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="from-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="from-group">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Book now!</button>
            </form>
        </div>
        <div class="col-md-4">
            <div class="row cart">
                <div class="col-md-11">
                Your cart
                    <hr>
                    <transition-group tag="div" class="transition-group">
                        <div v-for="item in basket.items" :key="item.bookable.id">
                            <div class="d-flex justify-content-between mb-2">
                                <router-link :to="{name: 'bookable', params:{id: item.bookable.id}}">{{item.bookable.title}}</router-link>
                                <span>${{item.priceBooking.price}}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>From {{item.lastSearch.from}}</span>
                                <span>To {{item.lastSearch.to}}</span>
                            </div>
                            <div>
                                <span class="fas fa-trash-alt" style="cursor: pointer" @click="$store.commit('removeFromBasket', item.bookable.id)"></span>
                            </div>
                            <hr>
                        </div>
                    </transition-group>

                </div>
                <div class="col-md-1">
                    <h6 v-if="itemsInBasket" class="badge badge-secondary font-weight-bolder text-uppercase">Items: {{itemsInBasket}}</h6>
                    <h6 v-else class="badge badge-secondary font-weight-bolder text-uppercase">Empty</h6>

                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {mapState, mapGetters} from 'vuex';
export default {
name: "basket",
    computed:{
    ...mapGetters(['itemsInBasket', 'basket'])
    }
}
</script>

<style scoped>
.cart h6
{
    font-size: 100%;
}
</style>
