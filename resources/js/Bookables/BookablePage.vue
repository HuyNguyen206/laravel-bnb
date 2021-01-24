<template>
    <div>
        <div v-if="listItem.length > 0">
        <div class="row mb-2" v-for="row in rows" :key="`row-${row}`">
            <div class="col-4 d-flex align-items-stretch" v-for="(item, index) in getItemPerRow(row)" :key="`column-${index}`">
                <bookable-list-item  :item="item">

                </bookable-list-item>
            </div>
            <div class="col-4 d-flex align-items-stretch" v-for="holder in placeHolderInRow(row)" :key="`holder-${holder}`">
                <bookable-list-item  :item="placeHolder">

                </bookable-list-item>
            </div>
        </div>

    </div>
        <div v-else> Loading ...</div>
    </div>


</template>

<script>
    import BookableListItem from "./BookableListItem";
    export default {
        name: "BookablePage",
        components: {
            BookableListItem
        },
        data(){
            return {
                listItem: [],
                column : 3,
                placeHolder:{
                    title:'holder',
                    content:'holder'
                }

            }
        },
        created() {
           axios.get('/api/bookables')
            .then(({data}) => this.listItem = data.data)
        },
        computed:{
            rows(){
                return this.listItem.length ? Math.ceil(this.listItem.length/this.column) : 0
            }
        },
        methods:{
            getItemPerRow(row){
               return this.listItem.slice((row-1)*this.column, row*this.column)
            },
            placeHolderInRow(row)
            {
                return this.column - this.getItemPerRow(row).length
            }
        }
    }
</script>

<style scoped>

</style>
