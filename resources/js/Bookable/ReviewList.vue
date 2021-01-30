<template>
        <div class="border-bottom mb-2 pb-2">
            <div class="row">
                <div class="col-md-6">
                    Huy
                </div>
                <div class="col-md-6">
                    <span class="float-right">
                        <star-rating :value="review.rating" class="fa-lg"></star-rating>
                   </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ review.created_at | momentAgo }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{review.content}}
                </div>
            </div>

        </div>

</template>

<script>

export default {
    name: "ReviewList",
    props: ['review'],
}
</script>

<style scoped>

</style>
