<template>
    <div>
        <ReportsSalesOBS></ReportsSalesOBS>
        <div class="row">
            <ReportsRevenueLineChart></ReportsRevenueLineChart>
        </div>
        <div class="row custom-row">
            <!-- Sales Order Status -->
            <div class="col-md-4 custom-row__col">
                <ReportsSalesOrdersByStatusChart></ReportsSalesOrdersByStatusChart>
            </div>
            <!-- Sales Order Status All Sales Agent -->
            <div class="col-md-8 ">
                <ReportsSalesOrdersAgents></ReportsSalesOrdersAgents>
            </div>
        </div>
        <div class="row custom-row">
            <!-- reports open revenue - pie chart -->
            <div class="col-md-4 custom-row__col">
                <ReportsOpenRevenue></ReportsOpenRevenue>
            </div>
            <!-- sales order by status for each insurance - table  -->
            <div class="col-md-8">
                <ReportsSOSPI></ReportsSOSPI>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ReportsRevenuePerInsurance></ReportsRevenuePerInsurance>
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
    import ReportsRevenuePerInsurance from './insurance/ReportsRevenuePerInsurance';

    export default {
        name: 'TheReports',

        components: {
            ReportsSalesOrdersByStatusChart,
            ReportsSalesOBS,
            ReportsSalesOrdersAgents,
            ReportsRevenueLineChart,
            ReportsOpenRevenue,
            ReportsRevenuePerInsurance,
            ReportsSOSPI
        }
    }
</script>

<style lang="sass" scoped>
.custom-row
    display: flex 
    align-items: stretch

    &__col
        display: flex 
        align-items: stretch

        .panel.panel-primary
            flex-grow: 1
</style>