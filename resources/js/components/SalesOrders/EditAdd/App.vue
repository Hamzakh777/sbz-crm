<template>
    <div>
        <SalesOrdersContractPanel></SalesOrdersContractPanel>
        <SalesOrdersPeople></SalesOrdersPeople>
    </div>
</template>

<script>
    import SalesOrdersContractPanel from './SalesOrdersContractPanel';
    import SalesOrdersContractPath from './SalesOrdersContractPath';
    import SalesOrdersPeople from './SalesOrdersPeople/SalesOrdersPeople';

    export default {
        name: 'App',

        components: {
            SalesOrdersContractPanel,
            SalesOrdersContractPath,
            SalesOrdersPeople
        }

    }
</script>

<style lang="scss" scoped>

</style>