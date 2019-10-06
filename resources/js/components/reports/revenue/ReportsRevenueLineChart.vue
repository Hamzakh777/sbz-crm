<template>
    <BaseReportsPanel
        :additionalClasses="['panel--transparent']"
        :title="'reports.revenue'"
    >
        <template #headLeft>
            <div>
                <BaseReportsDropdown
                    :timeframes="['quarter', 'half_year', 'year']"
                    @select-changed="setTimeframe"
                ></BaseReportsDropdown>
            </div>
        </template>
        <template #body>
            <div class="line-chart">
                <BaseLineChart
                    :chartData="chartData"
                    :options="chartOption"
                >
                </BaseLineChart>
            </div>
        </template>
    </BaseReportsPanel>
</template>

<script>
    import BaseReportsPanel from '../baseComponents/BaseReportsPanel';
    import BaseLineChart from '../baseComponents/BaseLineChart';
    import BaseReportsDropdown from '../baseComponents/BaseReportsDropdown';
    import ReportsTimeframeMixin from '../../../mixins/reports/ReportsTimeframeMixin';

    export default {
        name: 'ReportsRevenueLineChart',

        mixins: [ReportsTimeframeMixin],

        components: {
            BaseReportsPanel,
            BaseLineChart,
            BaseReportsDropdown
        },

        computed: {
            chartData() {
                let labels = [];
                let data = [];
                let data2 = [];
                // const object = this.DataToLoad;

                // for (const key in object) {
                //     if (object.hasOwnProperty(key)) {
                //     const element = object[key];

                //     labels.push(key.replace("_", " ").toUpperCase());
                //     data.push(element);
                //     }
                // }

                labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
                data = [12, 2, 5, 10, 9, 3, 6, 24, 4, 10, 2, 5];
                data2 = [24, 4, 10, 2, 5, 10, 9, 3, 6, 12, 1, 4];

                return {
                    labels,
                    datasets: [
                    {
                        label: this.label,
                        // backgroundColor: this.backgroundColor,
                        backgroundColor: 'transparent',
                        borderColor: '#4e73df',
                        data
                    },
                    {
                        label: this.label,
                        borderColor: '#2ecc71',
                        backgroundColor: 'transparent',
                        data: data2
                    }
                    ]
                };
            },
            chartOption() {
                return { 
                    plugins: {
                    datalabels: false
                    },
                    maintainAspectRatio: false
                }
            }
        },

        data() {
            return {
            }
        },

        methods: {

        },

    }
</script>

<style lang="sass" scoped>
.line-chart 
    max-height: 400px
    position: relative
</style>