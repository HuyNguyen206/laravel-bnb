<template>
    <div class="mt-2">
        <h6 class="text-uppercase text-secondary font-weight-bold">Availability</h6>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="from" class="mb-0">From</label>
                    <input @keyup.enter="check" v-model="from"  type="text" name="from" class="form-control form-control-sm" placeholder="From date" id="from">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="to" class="mb-0">To</label>
                    <input  @keyup.enter="check" v-model="to" type="text" name="to" class="form-control form-control-sm" placeholder="To date" id="to">
                </div>
            </div>

        </div>
        <button class="btn btn-secondary btn-block" @click="check">Check</button>
    </div>
</template>

<script>
    export default {
        name: "Availability",
        methods:{
            check(){
                alert('I am checking')
            }
        }
    }
</script>

<style scoped>

</style>
