<template>
    <BaseReportsPanel
        :title="'reports.sales_orders_by_status'"
    >
        <template #headLeft>
            <BaseReportsDropdown
                :timeframes="timeframes"
                @select-changed="setTimeframe"
            >    
            </BaseReportsDropdown>
        </template>
        <template #body>
            <BaseLoader v-if="isLoading"></BaseLoader>
            <div class="chart">
                <BaseChartBar

                ></BaseChartBar>
            </div>
        </template>
    </BaseReportsPanel>
</template>

<script>
    import ReportsBarChart from '../ReportsBarChart';
    import BaseReportsPanel from '../baseComponents/BaseReportsPanel';
    import BaseReportsDropdown from '../baseComponents/BaseReportsDropdown';
    import BaseLoader from '../../baseComponents/BaseLoader';
    import ReportsTimeframeMixin from '../../../mixins/reports/ReportsTimeframeMixin';
    import BaseChartBar from '../baseComponents/BaseChartBar';

    export default {
        name: 'ReportsSalesOrdersByStatusChart',

        mixins: [ReportsTimeframeMixin],

        components: {
            ReportsBarChart,
            BaseReportsPanel,
            BaseReportsDropdown,
            BaseLoader,
            BaseChartBar
        },

        computed: {
            ChartData() {
                let labels = [];
                let data = [];

                for (const key in this.DataToLoad) {
                    if (this.DataToLoad.hasOwnProperty(key)) {
                        const element = this.DataToLoad[key];
                        
                        labels.push(key);
                        data.push(element);
                    }
                };

                labels = ['test1', 'test2'];
                data = [20, 30];

                return {
                    labels: labels,
                    datasets: [
                        {
                            label: this.label,
                            backgroundColor: this.backgroundColor, //'#E4572E'
                            data: data
                        }
                    ]
                };
            },

            /**
             * 
             * @return {object} chart options
             */
            chartOption() {
                return { 
                    plugins: {
                        datalabels: false
                    }
                }
            }
        },

        data() {
            return {
                timeframes: ['quarter', 'half_year', 'year'],
                routeUrl: '/api/reports/sales-orders'
            }
        },
    }
</script>

<style lang="sass" scoped>
.panel
    padding: 1.25em

    &__body

        &__top 
            display: flex
            flex-direction: row
            justify-content: space-between
            width: 100%
            maring-bottom: 0.625em

    &__title 
        font-size: 14px
        font-weight: bold
        color: #555

    &__select 
        -webkit-appearance: none
        -moz-appearance: none
        background-position: right 50%
        background-repeat: no-repeat
        font-size: 14px
        margin-top: -6px
        background-image: url('data:image/svg+xml;utf8,<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1"><path d="M4 8L0 4h8z"/></svg>')
        padding-right: 1.5em
        font-weight: bold
        color: #555
        border-radius: 0
        background-color: transparent
        border-color: transparent

</style>