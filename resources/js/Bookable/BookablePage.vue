<template>
    <div v-if="listItem.length > 0">
        <div class="row mb-2" v-for="row in rows" :key="`row-${row}`">
            <div class="col-4" v-for="(item, index) in getItemPerRow(row)" :key="`column-${index}`">
                <bookable-list-item  :item="item">

                </bookable-list-item>
            </div>
            <div class="col-4" v-for="holder in placeHolderInRow(row)" :key="`holder-${holder}`">
                <bookable-list-item  :item="placeHolder">

                </bookable-list-item>
            </div>
        </div>

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
            setTimeout(() => {
                this.listItem = [
                    {
                        title: 'Hotel 1',
                        content: 'This is hotel 1'
                    },
                    {
                        title: 'Hotel 2',
                        content: 'This is hotel 2'
                    },
                    {
                        title: 'Hotel 2',
                        content: 'This is hotel 2'
                    },
                    {
                        title: 'Hotel 2',
                        content: 'This is hotel 2'
                    },
                    {
                        title: 'Hotel 2',
                        content: 'This is hotel 2'
                    },
                    {
                        title: 'Hotel 2',
                        content: 'This is hotel 2'
                    },
                    {
                        title: 'Hotel 2',
                        content: 'This is hotel 2'
                    },
                    {
                        title: 'Hotel 2',
                        content: 'This is hotel 2'
                    }
                ]
            }, 50)
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
