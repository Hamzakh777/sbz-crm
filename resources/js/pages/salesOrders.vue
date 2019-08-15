<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <pagination 
                    :data="allSalesOrders" 
                    @pagination-change-page="changePage"
                    :limit="4"
                    :size="'small'"
                ></pagination>
            </div>
        </div>
    </div>
</template>

<script>
import SalesOrdersDataTable from '../components/SalesOrders/SalesOrdersDataTable.vue';
import Pagination from "laravel-vue-pagination";

import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'SalesOrdersApp',

    components: {
        SalesOrdersDataTable,
        Pagination
    },

    computed: mapGetters(['allSalesOrders']),

    methods: {
        ...mapActions(['fetchSalesOrders']),

        changePage(page = 1) {
            
        }
    },

    mounted() {
        console.log('working');
        this.fetchSalesOrders();
    },
}
</script>

<style lang="sass" scoped>

</style>