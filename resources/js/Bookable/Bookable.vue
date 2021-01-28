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
    export default {
        name: "Bookable",
        components: {Availability},
        data(){
            return{
                bookable:null,
                id: this.$route.params.id
            }
        },
        created() {
            axios.get(`/api/bookables/${this.id}`)
            .then(({data}) => this.bookable = data.data)
        }
    }
</script>

<style scoped>

</style>
