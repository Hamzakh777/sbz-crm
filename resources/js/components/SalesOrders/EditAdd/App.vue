<template>
    <div>
        <SalesOrdersContractPanel></SalesOrdersContractPanel>
        <SalesOrdersPeoplePanel></SalesOrdersPeoplePanel>
        <SalesOrdersTasksPanel></SalesOrdersTasksPanel>
    </div>
</template>

<script>
    import SalesOrdersContractPanel from './SalesOrdersContractPanel';
    import SalesOrdersContractPath from './SalesOrdersContractPath';
    import SalesOrdersPeoplePanel from './SalesOrdersPeople/SalesOrdersPeoplePanel';
    import SalesOrdersTasksPanel from './SalesOrdersTasksPanel';

    export default {
        name: 'App',

        components: {
            SalesOrdersContractPath,
            SalesOrdersContractPanel,
            SalesOrdersPeoplePanel,
            SalesOrdersTasksPanel
        }

    }
</script>

<style lang="scss" scoped>

</style>