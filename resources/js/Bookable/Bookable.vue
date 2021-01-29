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
            <availability></availability>
        </div>

    </div>
    <div v-else> Loading...</div>

</div>
</template>

<script>
    import Availability from "./Availability";
    import ReviewList from "./ReviewList";
    export default {
        name: "Bookable",
        components: {ReviewList, Availability},
        data(){
            return{
                bookable:null,
                id: this.$route.params.id,
                listReview: null
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
        }
    }
</script>

<style scoped>

</style>
