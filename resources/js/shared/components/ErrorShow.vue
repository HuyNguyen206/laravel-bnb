<template>
    <div class="invalid-feedback d-block" v-if="errorFor(listError, field)">
        <p class="mb-0" v-for="(err, index) in errorFor(listError, field)" :key="field+index">
            {{err}}
        </p>
    </div>
</template>

<script>
import error from "../mixins/error";
export default {
    name: "ErrorShow",
    props:['listError', 'field'],
    mixins:[error]
}
</script>

<style scoped>

</style>
