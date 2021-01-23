<template>
<div>
    <div class="card" >
        <div class="card-body">
            <h5 class="card-title">{{item.title}}</h5>
            <p class="card-text">{{item.content}}</p>
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
