<template>
    <BaseReportsPanel
        :title="'reports.sales_orders_for_each_agent'"
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
            <table class="vtable">
                <thead class="thead">
                    <tr>
                        <th>Agent</th>
                        <th>Month</th>
                        <th>Quarter</th>
                        <th>Half Year</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <tr>
                        <td>Test agent</td>
                        <td><span class="won">20</span><b> / </b><span class="open">30</span></td>
                        <td><span class="won">20</span><b> / </b><span class="open">30</span></td>
                        <td><span class="won">20</span><b> / </b><span class="open">30</span></td>
                        <td><span class="won">20</span> / <span class="open">30</span></td>
                    </tr>
                    <tr>
                        <td>Test agent</td>
                        <td><span class="won">20</span><b> / </b><span class="open">30</span></td>
                        <td><span class="won">20</span><b> / </b><span class="open">30</span></td>
                        <td><span class="won">20</span><b> / </b><span class="open">30</span></td>
                        <td><span class="won">20</span> / <span class="open">30</span></td>
                    </tr>
                    <tr>
                        <td>Test agent</td>
                        <td><span class="won">20</span><b> / </b><span class="open">30</span></td>
                        <td><span class="won">20</span><b> / </b><span class="open">30</span></td>
                        <td><span class="won">20</span><b> / </b><span class="open">30</span></td>
                        <td><span class="won">20</span> / <span class="open">30</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="pagination">
                <paginate
                    :page-count="6"
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
    import BaseLoader from '../../baseComponents/BaseLoader';
    import Paginate from 'vuejs-paginate';

    export default {
        name: 'ReportsSalesOrdersAgents',

        components: {
            BaseReportsPanel,
            Paginate,
            BaseLoader
        },

        data() {
            return {
                url: '/api/reports/sales-orders-for-each-agent',
                isLoading: false
            }
        },

        methods: {
            /**
             * 
             */
            changePage(page) {
                console.log(page);
            },

            async fetchData() {
                this.isLoading = true;
                try {
                    const response = await axios.get(this.url);

                    this.isLoading = false;
                    console.log(response)
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