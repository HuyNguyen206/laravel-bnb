<template>
    <div class="row">
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
                        ></textarea>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            review: {
                rating: 5,
                content: null
            },
            existingReview: {
                created_at:null
            },
            loading: false,
            booking: {
                id:null,
                from:null,
                to:null,
                bookable:{

                }
            }
        };
    },
    created() {
        this.loading = true;
        // 1. If review already exists (in reviews table by id)
        axios
            .get(`/api/reviews/${this.$route.params.id}`)
            .then(response => {
                this.existingReview = response.data.data;
            })
            .catch(err => {
                if (
                    err.response &&
                    err.response.status &&
                    404 === err.response.status
                ) {
                    // 2. Fetch a booking by a review key
                    return axios
                        .get(`/api/booking-by-review/${this.$route.params.id}`)
                        .then(response => {
                            this.booking = response.data.data;
                        });
                }
            })
            .then(() => {
                this.loading = false;
            });
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
    }
};
</script>
