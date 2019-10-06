<template>
    <BaseReportsPanel
        :title="'reports.sales_orders_by_status_for_each_insurance'"
    >
        <template #headLeft>
            <BaseReportsDropdown
                :timeframes="timeframes"
                @select-changed="setTimeframe"
            >
            </BaseReportsDropdown>
        </template>
        <template #body>
            <BaseReportsTable>
                <template #thead>
                    <tr>
                        <th>{{ trans.get('voyager.insurance.insurance') }}</th>
                        <th>{{ trans.get('voyager.sales_orders.entry') }}</th>
                        <th>{{ trans.get('voyager.sales_orders.processing') }}</th>
                        <th>{{ trans.get('voyager.sales_orders.closing') }}</th>
                    </tr>
                </template>
                <template #tbody>
                    <tr>
                        <td>test</td>
                        <td>test1</td>
                        <td>test2</td>
                        <td>test3</td>
                    </tr>
                    <tr>
                        <td>test</td>
                        <td>test1</td>
                        <td>test2</td>
                        <td>test3</td>
                    </tr>
                </template>
            </BaseReportsTable>
        </template>
    </BaseReportsPanel>
</template>

<script>
    import BaseReportsPanel from '../baseComponents/BaseReportsPanel';
    import BaseReportsTable from '../baseComponents/BaseReportsTable';
    import BaseReportsDropdown from '../baseComponents/BaseReportsDropdown';
    import ReportsTiemframeMixin from '../../../mixins/reports/ReportsTimeframeMixin';

    // all order status per insurance
    export default {
        name: 'ReportsSalesOrdersStatusPerInsurance',

        mixins: [ReportsTiemframeMixin],

        components: {
            BaseReportsPanel,
            BaseReportsTable,
            BaseReportsDropdown
        },

        data() {
            return {
                timeframes: ['month', 'quarter', 'half_year', 'year']
            }
        },
    }
</script>

<style lang="sass" scoped>

</style>