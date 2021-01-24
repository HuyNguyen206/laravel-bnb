<template>
<div class="w-100 h-100">
    <div class="card w-100 h-100" >
        <div class="card-body">
            <router-link :to="{name: 'bookable', params: {id: item.id}}">
                <h5 class="card-title">{{item.title}}</h5>
            </router-link>

            <p class="card-text">{{item.description}}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "BookableListItem",
        props: ['item']
    }
</script>

<style scoped>

</style>
