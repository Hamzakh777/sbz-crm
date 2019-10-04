<template>
    <div class="row">
        <div class="col-md-4">
            <ReportsCard 
                :title="'reports.sales_orders_entry'"
                :value="1000"
                :color="'#555'"
            >
            </ReportsCard>
        </div>
        <div class="col-md-4">
            <ReportsCard 
                :title="'reports.sales_orders_processing'"
                :value="1000"
                :color="'#4e73df'"
            >
            </ReportsCard>
        </div>
        <div class="col-md-4">
            <ReportsCard 
                :title="'reports.sales_orders_closing'"
                :value="1000"
                :color="'#2ecc71'"
            >
            </ReportsCard>
        </div>
    </div>
</template>

<script>
    import ReportsCard from './ReportsCard';

    export default {
        name: 'ReportsSalesOrdersByStatus', 
        
        components: {
            ReportsCard
        }
    }
</script>

<style lang="sass" scoped>

</style>