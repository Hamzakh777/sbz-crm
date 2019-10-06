<template>
    <BaseReportsPanel
        :title="'reports.open_revenue_share'"
    >
        <template #headLeft>
            <BaseReportsDropdown
                :timeframes="timeframes"
                @select-changed="setTimeframe"
            >
            </BaseReportsDropdown>
        </template>

        <template #body>
            <BasePieChart
                :chart-data="chartData"
                :options="chartOption"
            >
            </BasePieChart>
        </template>
    </BaseReportsPanel>
</template>

<script>
    import BaseReportsPanel from '../baseComponents/BaseReportsPanel';
    import BaseReportsDropdown from '../baseComponents/BaseReportsDropdown';
    import ReportsTimeframeMixin from '../../../mixins/reports/ReportsTimeframeMixin';
    import BasePieChart from '../baseComponents/BasePieChart';

    export default {
        name: 'ReportsOpenRevenueShare',

        mixins: [ReportsTimeframeMixin],

        components: {
            BaseReportsPanel,
            BaseReportsDropdown,
            BasePieChart
        },

        computed: {
            chartData() {
                let labels = [];
                let data = [];
                // const object = this.DataToLoad;

                // for (const key in object) {
                //     if (object.hasOwnProperty(key)) {
                //     const element = object[key];

                //     labels.push(key.replace("_", " ").toUpperCase());
                //     data.push(element);
                //     }
                // }

                data = [20, 40, 10, 60, 80, 23];
                return {
                    labels,
                    datasets: [
                    {
                        backgroundColor: [
                        "#41B883",
                        "#E46651",
                        "#00D8FF",
                        "#DD1B16",
                        "#00ffff",
                        "#a4a4a4"
                        ],
                        data
                    }
                    ]
                };
            },

            chartOption() {
                return { 
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = (value*100 / sum).toFixed(2)+"%";
                                if(percentage != '0.00%') {
                                    return percentage;
                                }
                            },
                            color: '#000',
                        }
                    }
                }
            }
        },

        data() {
            return {
                timeframes: ['month', 'quarter', 'half_year', 'year'],
            }
        },
    }
</script>

<style lang="sass" scoped>

</style>