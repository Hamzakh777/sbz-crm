<template>
    <div class="row">
        <div class="col-md-4">
            <ReportsCard 
                :title="'reports.sales_orders_entry'"
                :value="entry"
                :color="'#555'"
            >
            </ReportsCard>
        </div>
        <div class="col-md-4">
            <ReportsCard 
                :title="'reports.sales_orders_processing'"
                :value="processing"
                :color="'#4e73df'"
            >
            </ReportsCard>
        </div>
        <div class="col-md-4">
            <ReportsCard 
                :title="'reports.sales_orders_closing'"
                :value="closing"
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
        },

        data() {
            return {
                entry: 0,
                processing: 0,
                closing: 0
            }
        },

        mounted() {
            // send a request with a yearly timeframe 
            axios.get('api/reports/sales-orders')        
                .then((response) => {
                    const data = response.data.salesOrdersByStatusYearly;
                    
                    this.entry = data.entry;
                    this.processing = data.processing;
                    this.closing = data.closing;
                })
                .catch((err) => console.log(err));
        }
    }
</script>

<style lang="sass" scoped>

</style>