<template>
    <div>
        <contractPanel></contractPanel>
        <SalesOrdersPeoplePanel></SalesOrdersPeoplePanel>
        <documentPanel></documentPanel>
        <SalesOrdersTasksPanel></SalesOrdersTasksPanel>
    </div>
</template>

<script>
    import contractPanel from './contractPanel';
    import SalesOrdersContractPath from './SalesOrdersContractPath';
    import SalesOrdersPeoplePanel from './SalesOrdersPeople/peoplePanel';
    import SalesOrdersTasksPanel from './SalesOrdersTasksPanel';
    import documentPanel from './documentPanel';

    export default {
        name: 'App',

        components: {
            SalesOrdersContractPath,
            contractPanel,
            SalesOrdersPeoplePanel,
            SalesOrdersTasksPanel,
            documentPanel
        }

    }
</script>

<style lang="scss" scoped>

</style>