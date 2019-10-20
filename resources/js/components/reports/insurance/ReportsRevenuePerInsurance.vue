<template>
    <BaseReportsPanel
        :title="'reports.revenue_per_insurance'"
    >
        <template #headLeft>
            <div class="legend">
                <div class="square square--won"></div>
                <span>{{ trans.get('reports.won') }}</span>
            </div>
            <div class="legend">
                <div class="square square--open"></div>
                <span>{{ trans.get('reports.open') }}</span>
            </div>
        </template>
        <template #body>
            <BaseLoader v-if="isLoading">
            </BaseLoader>
            <BaseReportsTable>
                <template #thead>
                    <tr>
                        <th>{{ trans.get('voyager.insurance.insurance') }}</th>
                        <th>{{ trans.get('reports.month') }}</th>
                        <th>{{ trans.get('reports.quarter') }}</th>
                        <th>{{ trans.get('reports.half_year') }}</th>
                        <th>{{ trans.get('reports.year') }}</th>
                    </tr>
                </template>
                <template #tbody>
                    <tr 
                        v-for="(insurance, index) in insurances" 
                        :key="index"
                    >
                        <td>{{ insurance.name | capitalize }}</td>
                        <td><span class="won">{{ insurance.revenue.month.closed }}chf</span><b> / </b><span class="open">{{ insurance.revenue.month.open }}chf</span></td>
                        <td><span class="won">{{ insurance.revenue.quarter.closed }}chf</span><b> / </b><span class="open">{{ insurance.revenue.quarter.open }}chf</span></td>
                        <td><span class="won">{{ insurance.revenue.half_year.closed }}chf</span><b> / </b><span class="open">{{ insurance.revenue.half_year.open }}chf</span></td>
                        <td><span class="won">{{ insurance.revenue.year.closed }}chf</span> / <span class="open">{{ insurance.revenue.year.open }}chf</span></td>
                    </tr>
                </template>
            </BaseReportsTable>
            <div class="pagination">
                <paginate
                    v-if="numOfPages > 1"
                    :page-count="numOfPages"
                    :click-handler="changePage"
                    :prev-text="trans.get('voyager.generic.next')"
                    :next-text="trans.get('voyager.generic.previous')"
                    :container-class="'pagination'"
                    >
                </paginate>
            </div>
        </template>
    </BaseReportsPanel>
</template>

<script>
    import BaseReportsPanel from '../baseComponents/BaseReportsPanel';
    import BaseReportsTable from '../baseComponents/BaseReportsTable';
    import BaseLoader from '../../baseComponents/BaseLoader';
    import BaseReportsDropdown from '../baseComponents/BaseReportsDropdown';
    import ReportsTiemframeMixin from '../../../mixins/reports/ReportsTimeframeMixin';
    import Paginate from 'vuejs-paginate';

    // all order status per insurance
    export default {
        name: 'ReportsRevenuePerInsurance',

        components: {
            BaseReportsPanel,
            BaseReportsTable,
            BaseReportsDropdown,
            Paginate,
            BaseLoader,
        },

        data() {
            return {
                url: '/api/reports/insurance/revenue',
                isLoading: false,
                numOfPages: 1,
                insurances: []
            }
        },

        methods: {
            changePage(page) {
                this.fetchData(page);

            },

            async fetchData(page = 1) {
                this.isLoading = true;

                try {
                    const response = await axios.get(this.url + '?page=' + page);

                    this.isLoading = false;

                    this.insurances = response.data.revenueForEachInsurance;
                    this.numOfPages = response.data.numOfPages;

                } catch (error) {
                    this.isLoading = false;
                    throw error;

                }
            }
        },

        mounted() {
            this.fetchData();
        }
    }
</script>

<style lang="sass" scoped>
$blue: #4e73df
$green: #2ecc71

.legend 
    display: inline-block
    
    .square 
        height: 16px 
        width: 16px 
        box-shadow: 0px 2px 6px rgba(0,0,0,0.2)
        background-color: #555
        display: inline-block
        margin-right: 4px

        &--won 
            background-color: $green

        &--open 
            background-color: $blue

    &:nth-child(1)
        margin-right: 10px 

.vtable 
    width: 100% 
    margin-top: 0.75em

    .tbody

        tr

            td 
                padding: 1em 0
                border-top: 1px solid #B5B9C1

            &:nth-child(1)
                td
                    border-top: none
    .won
        color: $green

    .open 
        color: $blue

.pagination
    margin-bottom: -10px !important    
</style>