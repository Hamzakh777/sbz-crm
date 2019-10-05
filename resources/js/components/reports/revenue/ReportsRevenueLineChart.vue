<template>
    <BaseReportsPanel
        :additionalClasses="['panel--transparent']"
        :title="'reports.revenue'"
    >
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
    import BaseReportsPanel from '../../baseComponents/BaseReportsPanel';
    import BaseLineChart from '../../baseComponents/BaseLineChart';

    export default {
        name: 'ReportsRevenueLineChart',

        components: {
            BaseReportsPanel,
            BaseLineChart
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

                labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
                data = [12, 2, 5, 10, 9, 3, 6, 24, 4, 10, 2, 5];

                return {
                    labels,
                    datasets: [
                    {
                        label: this.label,
                        backgroundColor: this.backgroundColor,
                        data
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

    }
</script>

<style lang="sass" scoped>
.line-chart 
    max-height: 400px
    position: relative
</style>