<template>
    <div>
        <ReportsSalesOBS></ReportsSalesOBS>
        <div class="row">
            <ReportsRevenueLineChart></ReportsRevenueLineChart>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- Sales Order Status -->
                <reports-panel 
                    :timeFrames="['quarter', 'half_year', 'year']"
                    :title="'reports.sales_orders_by_status'"
                >
                </reports-panel>

            </div>
            <!-- Sales Order Status All Sales Agent -->
            <div class="col-md-8">
                <ReportsSalesOrdersAgents></ReportsSalesOrdersAgents>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <ReportsOpenRevenue></ReportsOpenRevenue>
            </div>
        </div>
    </div>
</template>

<script>
    import ReportsPanel from './ReportsPanel';
    import ReportsSalesOBS from './ReportsSalesOrdersByStatus';
    import ReportsSalesOrdersAgents from './ReportsSalesOrdersAgents';
    import ReportsRevenueLineChart from './revenue/ReportsRevenueLineChart';
    import ReportsOpenRevenue from './revenue/ReportsOpenRevenueShare';

    export default {
        name: 'TheReports',

        components: {
            ReportsPanel,
            ReportsSalesOBS,
            ReportsSalesOrdersAgents,
            ReportsRevenueLineChart,
            ReportsOpenRevenue
        }
    }
</script>

<style lang="scss" scoped>

</style>