<template>
    <div>
        <div class="form-group">
            <label for="" class="text-muted"> Choose your rating</label>
            <star-rating :rating="review.rating" class="fa-2x"  v-model="review.rating"></star-rating>
        </div>
        <div class="form-group">
            <label for=""  class="text-muted">Input your review</label>
            <textarea name="review" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary btn-lg btn-block">Submit</button>
    </div>
</template>

<script>
    export default {
        name: "Review",
        data(){
            return {
                review:{
                    rating: 5,
                    content: null
                }
            }
        },
        methods:{
            // onRatingChange(rating)
            // {
            //     this.review.rating = rating
            // }
        }
    }
</script>

<style scoped>

</style>
