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
                                {{ trans.get('voyager.sales_orders.id') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.actions') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.full_name') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.phone_number') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.sales_date') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.contract_start_year') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.sales') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.insurance') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.sales_order_status') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.provison_done') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.cancellation_original') }}
                            </th>
                            <th>
                                {{ trans.get('voyager.sales_orders.cancellation_stamped') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(salesOrder, index) in allSalesOrders.data" :key="index">
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
                            <td>
                                test
                            </td>
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