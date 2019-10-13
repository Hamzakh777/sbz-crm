<template>
    <div>
        <ReportsSalesOBS></ReportsSalesOBS>
        <div class="row">
            <ReportsRevenueLineChart></ReportsRevenueLineChart>
        </div>
        <div class="row d-md-flex align-items-stretch">
            <!-- Sales Order Status -->
            <div class="col-md-4 d-flex align-items-stretch">
                <ReportsSalesOrdersByStatusChart></ReportsSalesOrdersByStatusChart>
            </div>
            <!-- Sales Order Status All Sales Agent -->
            <div class="col-md-8 ">
                <ReportsSalesOrdersAgents></ReportsSalesOrdersAgents>
            </div>
        </div>
        <div class="row">
            <!-- reports open revenue - pie chart -->
            <div class="col-md-4">
                <ReportsOpenRevenue></ReportsOpenRevenue>
            </div>
            <!-- sales order by status for each insurance - table  -->
            <div class="col-md-8">
                <ReportsSOSPI></ReportsSOSPI>
            </div>
        </div>
    </div>
</template>

<script>
    import ReportsSalesOrdersByStatusChart from './salesOrders/ReportsSalesOrdersByStatusChart';
    import ReportsSalesOBS from './salesOrders/ReportsSalesOrdersByStatus';
    import ReportsSalesOrdersAgents from './salesOrders/ReportsSalesOrdersAgents';
    import ReportsRevenueLineChart from './revenue/ReportsRevenueLineChart';
    import ReportsOpenRevenue from './revenue/ReportsOpenRevenueShare';
    import ReportsSOSPI from './insurance/ReportsSalesOrdersStatusPerInsurance';

    export default {
        name: 'TheReports',

        components: {
            ReportsSalesOrdersByStatusChart,
            ReportsSalesOBS,
            ReportsSalesOrdersAgents,
            ReportsRevenueLineChart,
            ReportsOpenRevenue,
            ReportsSOSPI
        }
    }
</script>

<style lang="sass" scoped>

</style>