<template>
    <div>
<!--        <i class="fas fa-star" v-for="i in 5" :key="i" :style="getColor(i, rating)"></i>-->
        <span>{{value}}</span>
        <i class="fas fa-star" v-for="i in fullStar" :key="'full' + i" @click="$emit('input', i)"></i>
        <i class="fas fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star" v-for="i in emptyStar" :key="'empty' + i" @click="$emit('input',fullStar + i)"></i>
    </div>

</template>

<script>
    export default {
        name: "StarRating",
        props: ['value'],
        computed: {
            emptyStar() {
                return 5 - Math.ceil(this.value)
            },
            halfStar() {
                const fraction = Math.round(
                    (this.value) - Math.floor(this.value)
                )
                return fraction > 0 && fraction < 50
            },
            fullStar() {
                return  Math.round(this.value)
            }
        },
        methods: {
            getColor(i, value) {
                return i <= value ? 'color:orange' : 'color:#8080806b'
            }
        }
    }
</script>

<style scoped>

</style>
