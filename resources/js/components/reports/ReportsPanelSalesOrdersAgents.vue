<template>
    <div class="panel panel-primary panelbordered">
        <BaseLoader v-if="isLoading"></BaseLoader>
        <div class="panel-body mt-2">
            <div class="panel__body__top">
                <h4 class="panel__title">
                    {{ trans.get('reports.total_sales_orders_for_each_agent') }}
                </h4>
                <select
                    @change="setTimeFrame"
                    class="panel__select"
                >
                    <option 
                        v-for="(timeFrame, index) in timeFrames"
                        :value="timeFrame" 
                        :key="index"
                        :selected="index === 0"
                    >
                        {{ trans.get(`reports.${timeFrame}`) }}
                    </option>
                </select>
            </div>
            <ReportsBarChart>
                
            </ReportsBarChart>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ReportsSalesOrdersAgents'
    }
</script>

<style lang="scss" scoped>

</style>