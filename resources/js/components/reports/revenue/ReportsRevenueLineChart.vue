<template>
    <BaseReportsPanel
        :additionalClasses="['panel--transparent']"
        :title="'reports.revenue'"
    >
        <template #headLeft>
            <div>
                <BaseReportsDropdown
                    :timeframes="['month', 'quarter', 'half_year', 'year']"
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
                let closedProvision = [];
                let openProvision = [];

                if(this.responseData !== null && this.responseData !== undefined) {
                    const object = this.responseData.cols;

                    for (const key in object) {
                        if (object.hasOwnProperty(key)) {
                            const element = object[key];

                            labels.push(key);
                            closedProvision.push(element.closedProvision);
                            openProvision.push(element.openProvision);
                        }
                    }
                }
                
                return {
                    labels,
                    datasets: [
                    {
                        label: this.trans.get('reports.open'),
                        // backgroundColor: this.backgroundColor,
                        backgroundColor: '#4e73df',
                        data: openProvision
                    },
                    {
                        label: this.trans.get('reports.closed'),
                        backgroundColor: '#2ecc71',
                        data: closedProvision
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
                routeUrl: '/api/reports/revenue/total-revenue'
            }
        },
    }
</script>

<style lang="sass" scoped>
.line-chart 
    max-height: 400px
    position: relative
</style>