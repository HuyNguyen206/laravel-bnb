<template>
    <div>
        <div class="row" v-if="error">
            <div class="col-md-12 mt-5">
                <fatal-error></fatal-error>
            </div>
        </div>
        <div v-if="success">
            <success>
                You've left a review, thank you very much!
            </success>
        </div>
        <div class="row" v-if="!error && !success">
                <div
                    :class="firstColumn"
                >
                    <div class="card">
                        <div class="card-body">
                            <div v-if="loading">Loading...</div>
                            <div v-else>
                                <p>
                                    Stayed at
                                    <router-link
                                        :to="{name: 'bookable', params: { id: booking.bookable.bookable_id}}"
                                    >{{ booking.bookable.title }}</router-link>
                                </p>
                                <p>From {{ booking.from }} to {{ booking.to }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    :class="secondColumn"
                >
                    <div v-if="loading">Loading...</div>
                    <div v-else>
                        <div v-if="alreadyReviewed">
                            <h3>You've already left a review for this booking!</h3>
                        </div>
                        <div v-else>
                            <form action="" @submit.prevent="submitReview()">
                                <div class="form-group">
                                    <label class="text-muted">Select the star rating (1 is worst - 5 is best)</label>
                                    <star-rating class="fa-3x" v-model="review.rating"></star-rating>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="text-muted">Describe your expirience with</label>
                                    <textarea
                                        name="content"
                                        cols="30"
                                        rows="10"
                                        class="form-control"
                                        v-model="review.content"
                                        :class="{'is-invalid':errorFor(errors, 'content')}"
                                    ></textarea>
                                    <error-show :list-error="errors" field="content"></error-show>
                                </div>


                                <button type="submit" class="btn btn-lg btn-primary btn-block" :disabled="sending">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
        </div>
    </div>

</template>

<script>
import {is404, is422} from "../shared/utils/response";
import error from "../shared/mixins/error";
export default {
    mixins: [error],
    data() {
        return {
            reviewIdInUrl:this.$route.params.id,
            review: {
                id:null,
                rating: 5,
                content: null
            },
            existingReview: {
                created_at:null
            },
            booking: {
                id:null,
                from:null,
                to:null,
                bookable:{

                }
            },
            error:false,
            sending:false,
            success:false,
        };
    },
    async created() {
        this.loading = true;
        // 1. If review already exists (in reviews table by id)
        try {
            this.existingReview = (await axios.get(`/api/reviews/${this.reviewIdInUrl}`)).data.data
        }
       catch(err)
       {
           console.log('log err', err)
           if (is404(err)) {
               console.log('404')
               // 2. Fetch a booking by a review key
               try {
                   this.booking= (await axios.get(`/api/booking-by-review/${this.reviewIdInUrl}`)).data.data
                   this.review.id = this.$route.params.id
               }
               catch (err)
               {
                   if(!is404(err))
                   {
                       this.error = true
                   }
               }
           }
           else
           {
               this.error = true
           }
       }
        this.loading = false;
        // 3. Store the review
    },
    computed: {
        firstColumn(){
            console.log('test ',this.loading)
            console.log('test ',this.alreadyReviewed)
            return [{'col-md-4': this.loading || !this.alreadyReviewed}, {'d-none': !this.loading && this.alreadyReviewed}]
        },
        secondColumn(){
            return [{'col-md-8': this.loading || !this.alreadyReviewed}, {'col-md-12': !this.loading && this.alreadyReviewed}]
        },
        alreadyReviewed() {
            return this.hasReview || this.booking.id == null;
        },
        hasReview() {
            return this.existingReview.created_at !== null;
        },
        hasBooking() {
            return this.booking.id !== null;
        }
    },
    methods:{
        submitReview(){
            this.sending =true
            this.success = false
            axios.post(`/api/reviews`, this.review)
            .then(res => {
                if(res.status == 201)
                {
                    this.success = true
                }
                // this.$router.push({name: 'bookable', params:{id:this.booking.bookable.bookable_id}})
            })
            .catch(err => {
                if(is422(err))
                {
                    const errors = err.response.data.errors;
                    if(errors['content'] && _.size(errors) == 1)
                    {
                        this.errors = errors;
                        return
                    }
                }
                this.error = true

            })
            .then(() => {
                this.sending =false
            })
        }
    }
};
</script>
