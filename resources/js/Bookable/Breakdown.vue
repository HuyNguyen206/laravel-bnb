<template>
    <div>
        <h6 class="text-uppercase text-muted">
            price breakdown
        </h6>
        <ul class="list-cost pl-0">
            <li v-for="(days, price) in priceBooking.breakdown" :key="price" class="d-flex justify-content-between">
            <span>
               {{ pluralDay(days) }} x ${{ price }}
            </span>
                <span>
                ${{ price * days }}
            </span>
            </li>
        </ul>
        <section class="d-flex justify-content-between mb-2">
        <span class="font-weight-bolder">
        Total
        </span>
            <span>
             ${{ priceBooking.price }}
        </span>
        </section>

    </div>
</template>

<script>
export default {
    name: "Breakdown",
    props: ['priceBooking'],
    methods: {
        pluralDay(days) {
            return days > 1 ? `${days} days` : `${days} day`
        }
    }
}
</script>

<style scoped>
ul.list-cost li {
    border-bottom: 1px solid #80808052;
    padding: 10px 0;
}
</style>
