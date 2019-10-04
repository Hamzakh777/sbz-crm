<template>
    <div>
        <ReportsSalesOBS></ReportsSalesOBS>
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
    </div>
</template>

<script>
    import ReportsPanel from './ReportsPanel';
    import ReportsSalesOBS from './ReportsSalesOrdersByStatus';
    import ReportsSalesOrdersAgents from './ReportsSalesOrdersAgents';

    export default {
        name: 'TheReports',

        components: {
            ReportsPanel,
            ReportsSalesOBS,
            ReportsSalesOrdersAgents
        }
    }
</script>

<style lang="scss" scoped>

</style>