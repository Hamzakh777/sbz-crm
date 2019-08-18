<template>
    <div>
        <SalesOrdersContractPanel></SalesOrdersContractPanel>
        <SalesOrdersPeoplePanel></SalesOrdersPeoplePanel>
    </div>
</template>

<script>
    import SalesOrdersContractPanel from './SalesOrdersContractPanel';
    import SalesOrdersContractPath from './SalesOrdersContractPath';
    import SalesOrdersPeoplePanel from './SalesOrdersPeople/SalesOrdersPeoplePanel';

    export default {
        name: 'App',

        components: {
            SalesOrdersContractPath,
            SalesOrdersContractPanel,
            SalesOrdersPeoplePanel,
        }

    }
</script>

<style lang="scss" scoped>

</style>