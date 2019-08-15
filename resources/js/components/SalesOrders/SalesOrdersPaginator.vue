<template>
    <div>
         <pagination 
            :data="allSalesOrders" 
            @pagination-change-page="changePage"
            :limit="4"
        ></pagination>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import Pagination from "laravel-vue-pagination";

    export default {
        name: 'SalesOrdersPaginator',

        components: {
            Pagination
        },

        computed: mapGetters(['allSalesOrders']),

         methods: {
        ...mapActions(['fetchSalesOrders']),

        changePage(page = 1) {
            
        }
    },

    }
</script>

<style lang="scss" scoped>

</style>