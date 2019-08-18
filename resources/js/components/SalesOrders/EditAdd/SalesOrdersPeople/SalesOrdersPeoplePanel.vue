<template>
     <div class="panel panel-primary panelbordered">
        <div class="panel-heading">
            <h3 class="panel-title panel-icon"><i class="voyager-search"></i>{{ trans.get('voyager.sales_orders.contract') }}</h3>
            <div class="panel-actions">
                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
            </div>
        </div>
        <div class="panel-body mt-2">
            <div class="row">
                <button
                    class="btn btn-success pull-right"
                    >
                    {{ trans.get('voyager.sales_orders.add_person') }}
                </button>
            </div>
            <div class="row cards">
                <salesOrdersPersonCard></salesOrdersPersonCard>
            </div>
        </div>
     </div>
</template>

<script>
    import SalesOrdersPersonCard from './SalesOrdersPersonCard';

    export default {
        name: 'SalesOrdersPeoplePanel',

        components: {
            SalesOrdersPersonCard
        }
    }
</script>

<style lang="sass" scoped>
.panel-body 
    margin-top: 1em    
    .cards 
        margin-top: 1em
</style>