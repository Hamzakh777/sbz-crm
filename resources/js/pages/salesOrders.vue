<template>
    <div class="row">
        <div class="col-md-12">
            <sales-orders-data-table>
            </sales-orders-data-table>
        </div>
    </div>
</template>

<script>
import SalesOrdersDataTable from '../components/SalesOrders/SalesOrdersDataTable.vue';
import Pagination from "laravel-vue-pagination";

import { mapActions } from 'vuex';

export default {
    name: 'SalesOrdersApp',

    components: {
        SalesOrdersDataTable,
        Pagination
    },

    methods: {
        ...mapActions(['fetchSalesOrders']),
    },

    mounted() {
        console.log('working');
        this.fetchSalesOrders();
    },
}
</script>

<style lang="sass" scoped>

</style>