<template>
    <div>
        <ReportsSalesOBS></ReportsSalesOBS>
        <div class="row">
            <ReportsRevenueLineChart></ReportsRevenueLineChart>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- Sales Order Status -->
                <ReportsSalesOrdersByStatusChart
                >
                </ReportsSalesOrdersByStatusChart>

            </div>
            <!-- Sales Order Status All Sales Agent -->
            <div class="col-md-8">
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
    import ReportsSalesOrdersByStatusChart from './ReportsSalesOrdersByStatusChart';
    import ReportsSalesOBS from './ReportsSalesOrdersByStatus';
    import ReportsSalesOrdersAgents from './ReportsSalesOrdersAgents';
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

<style lang="scss" scoped>

</style>