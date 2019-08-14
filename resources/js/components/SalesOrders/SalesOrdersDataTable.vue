<template>
    <div class="panel panel-bordered panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title panel-icon"><i class="voyager-search"></i>Table</h3>
            <div class="panel-actions">
                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                test
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(salesOrder, index) in allSalesOrders.data" :key="index">
                            <td>
                                test
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';

export default {
    name: 'SalesOrdersDataTables',

    computed: mapGetters(['allSalesOrders']),
}
</script>

<style lang="scss" scoped>

</style>