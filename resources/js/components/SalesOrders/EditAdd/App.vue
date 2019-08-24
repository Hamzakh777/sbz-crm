<template>
    <div>
        <contractPanel></contractPanel>
        <SalesOrdersPeoplePanel></SalesOrdersPeoplePanel>
        <SalesOrdersTasksPanel></SalesOrdersTasksPanel>
    </div>
</template>

<script>
    import contractPanel from './contractPanel';
    import SalesOrdersContractPath from './SalesOrdersContractPath';
    import SalesOrdersPeoplePanel from './SalesOrdersPeople/peoplePanel';
    import SalesOrdersTasksPanel from './SalesOrdersTasksPanel';

    export default {
        name: 'App',

        components: {
            SalesOrdersContractPath,
            contractPanel,
            SalesOrdersPeoplePanel,
            SalesOrdersTasksPanel
        }

    }
</script>

<style lang="scss" scoped>

</style>