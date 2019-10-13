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
                let labels = [
                    this.trans.get('reports.closed_provision'),
                    this.trans.get('reports.open_provision')
                ];
                let data = [0,0];

                if(this.responseData !== null) {
                    const closedProvision = this.responseData.closedProvision;
                    const openProvision = this.responseData.openProvision;
    
                    data = [];
                    data.push(closedProvision, openProvision);
                }

                return {
                    labels,
                    datasets: [
                        {
                            backgroundColor: [
                            "#2ecc71", // closed provision - green
                            "#4e73df", // open provision - blue
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
                routeUrl: '/api/reports/revenue/open-share',
            }
        },
    }
</script>

<style lang="sass" scoped>

</style>