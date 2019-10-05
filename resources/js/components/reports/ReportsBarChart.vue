<template>
    <div class="chart">
        <base-chart-bar :chart-data="ChartData" :options="chartOption"></base-chart-bar>
    </div>
</template>

<script>
import BaseChartBar from './baseComponents/BaseChartBar';

export default {
    name: 'ReportsChart',

    props: {
        DataToLoad: {
            type: Object,
            required: false
        },
        backgroundColor: {
            type: String
        },
        label: {
            type: String
        }
    },

    components: {
        BaseChartBar
    },

    computed: {
        /**
         * 
         * @return {object} Chart data and labels
         */
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
    }
}
</script>

<style scoped lang="sass">
.chart
    width: 100%
    padding: 0
</style>
