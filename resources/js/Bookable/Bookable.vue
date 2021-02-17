<template>
<div>
    <div class="row" v-if="bookable">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>{{bookable.title}}</h3>
                    <hr>
                    <p class="card-text">{{bookable.description}}</p>
                </div>
            </div>
            <div class="review mt-2 d-none d-md-block" style="padding: 1.25rem" >
                <h6 class="text-uppercase text-secondary font-weight-bolder">
                    Review List
                </h6>
                <div v-if="listReview">
                    <review-list v-for="(review,index)  in listReview" :key="index" :review="review"></review-list>
                </div>
                <div v-else>
                    No review available yet
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <availability @availability="checkPrice($event)"></availability>

                <div style="padding: 0 1.25rem;">
                    <transition name="fade">
                        <breakdown v-if="priceBooking.price" :priceBooking="priceBooking"></breakdown>
                    </transition>
                    <transition name="fade">
                        <button class="btn btn-primary btn-block" v-if="priceBooking.price" :disabled="inBasketAlready" @click="addToBasket()">Book now</button>
                    </transition>
                    <button class="btn btn-danger btn-block" v-if="inBasketAlready" :disabled="!inBasketAlready" @click="removeFromBasket(id)">Remove from basket</button>
                    <transition name="fade">
                        <div class="text-muted warning mt-2" v-if="inBasketAlready">
                            This booking already in the basket!
                        </div>
                    </transition>
                </div>

        </div>

    </div>
    <div v-else> Loading...</div>

</div>
</template>

<script>
    import Availability from "./Availability";
    import ReviewList from "./ReviewList";
    import Breakdown from "./Breakdown";
    import {mapState, mapGetters} from 'vuex'
    export default {
        name: "Bookable",
        components: {ReviewList, Availability,Breakdown},
        computed:{
            ...mapState({
                lastSearch: 'lastSearch'
            }),
            ...mapGetters({
                basket: 'basket'
            }),
            inBasketAlready()
            {
                return this.basket.items.some((item) => {
                    return item.bookable.id == this.id
                })
            }
        },
        data(){
            return{
                bookable:null,
                id: this.$route.params.id,
                listReview: null,
                priceBooking: {},
            }
        },
        created() {
            axios.get(`/api/bookables/${this.id}`)
            .then(({data}) => this.bookable = data.data)
            .catch(err => {
                console.log(err.response)
            });
            axios.get(`/api/bookables/${this.$route.params.id}/review`)
            .then(({data}) => {
                this.listReview = data.data
            })
            .catch(err => {
                    console.log(err.response)
            });
        },
        methods:{
           async checkPrice(data)
            {
                if(!data.hasAvailability)
                {
                    this.priceBooking = {};
                    return;
                }
                try {
                   this.priceBooking = (await axios.get(`/api/bookables/${this.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`)).data.data
                }
                catch (err)
                {

                }
            },
            addToBasket()
            {
                let basket = {
                    bookable: this.bookable,
                    priceBooking: this.priceBooking,
                    lastSearch: this.lastSearch
                }
                if(!this.inBasketAlready){
                    this.inBasket = false
                    this.$store.dispatch('addToBasket', basket)
                    // this.$store.commit('addToBasket', basket)
                }
            },
            removeFromBasket(id)
            {
                this.$store.commit('removeFromBasket', id)
            }

        }
    }
</script>

<style scoped>

</style>
