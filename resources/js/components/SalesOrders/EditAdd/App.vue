<template>
    <div>
        <ContractPanel></ContractPanel>
        <div v-if="salesOrder.id">
            <SalesOrdersPeoplePanel></SalesOrdersPeoplePanel>
            <DocumentPanel></DocumentPanel>
            <CompensationPanel
                :salesOrderPage="true"
                ></CompensationPanel>
            <SalesOrdersTasksPanel></SalesOrdersTasksPanel>
            <CommentsPanel></CommentsPanel>
        </div>
    </div>
</template>

<script>
    import ContractPanel from './contractPanel';
    import SalesOrdersPeoplePanel from './SalesOrdersPeople/peoplePanel';
    import SalesOrdersTasksPanel from './SalesOrdersTasksPanel';
    import DocumentPanel from './documents/documentPanel';
    import CommentsPanel from '../../comments/commentsPanel';
    import CompensationPanel from '../../compensation/compensationPanel';
    import {mapGetters} from 'vuex';

    export default {
        name: 'App',

        components: {
            ContractPanel,
            SalesOrdersPeoplePanel,
            SalesOrdersTasksPanel,
            DocumentPanel,
            CommentsPanel,
            CompensationPanel
        },

        computed: {
            ...mapGetters(['salesOrder']),
        },

    }
</script>

<style lang="scss" scoped>

</style>