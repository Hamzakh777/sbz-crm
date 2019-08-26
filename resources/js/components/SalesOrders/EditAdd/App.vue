<template>
    <div>
        <contractPanel></contractPanel>
        <div v-if="salesOrder.id">
            <SalesOrdersPeoplePanel></SalesOrdersPeoplePanel>
            <documentPanel></documentPanel>
            <SalesOrdersTasksPanel></SalesOrdersTasksPanel>
            <commentsPanel></commentsPanel>
        </div>
    </div>
</template>

<script>
    import contractPanel from './contractPanel';
    import SalesOrdersContractPath from './SalesOrdersContractPath';
    import SalesOrdersPeoplePanel from './SalesOrdersPeople/peoplePanel';
    import SalesOrdersTasksPanel from './SalesOrdersTasksPanel';
    import documentPanel from './documents/documentPanel';
    import commentsPanel from '../../comments/commentsPanel';
    import {mapGetters} from 'vuex';

    export default {
        name: 'App',

        components: {
            SalesOrdersContractPath,
            contractPanel,
            SalesOrdersPeoplePanel,
            SalesOrdersTasksPanel,
            documentPanel,
            commentsPanel
        },

        computed: {
            ...mapGetters(['salesOrder']),
        },

    }
</script>

<style lang="scss" scoped>

</style>