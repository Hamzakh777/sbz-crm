<template>
    <div>
        <ReportsSalesOBS></ReportsSalesOBS>
        <div class="row">
            <div class="col-md-4">
                <!-- Sales Order Status -->
                <reports-panel 
                    :timeFrames="['quarter', 'half_year', 'year']"
                >
                </reports-panel>

                <!-- Sales Order Status All Sales Agent -->
                
            </div>
        </div>
    </div>
</template>

<script>
    import ReportsPanel from './ReportsPanel';
    import ReportsSalesOBS from './ReportsSalesOrdersByStatus';

    export default {
        name: 'TheReports',

        components: {
            ReportsPanel,
            ReportsSalesOBS
        }
    }
</script>

<style lang="scss" scoped>

</style>