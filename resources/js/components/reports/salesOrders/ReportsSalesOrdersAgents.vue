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
        </template>
    </BaseReportsPanel>
</template>

<script>
    import BaseReportsPanel from '../baseComponents/BaseReportsPanel';

    export default {
        name: 'ReportsSalesOrdersAgents',

        components: {
            BaseReportsPanel
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

</style>