<template>
     <div class="panel panel-primary panelbordered">
        <div class="panel-heading">
            <h3 class="panel-title panel-icon"><i class="voyager-people"></i>{{ trans.get('voyager.generic.people') }}</h3>
            <div class="panel-actions">
                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
            </div>
        </div>
        <div class="panel-body mt-2">
            <div class="row">
                <button
                    class="btn btn-success pull-right"
                    @click="showAddPersonCard"
                    >
                    {{ trans.get('voyager.sales_orders.add_person') }}
                </button>
            </div>
            <div class="row cards">
                <!-- the form to add or edit a contract person -->
                <personCard 
                    :is-edit-add="true"
                    v-if="isAddingPersonViewOpen"
                >
                </personCard>
                <!-- for viewing already added contract people -->
                <personCard 
                    :is-edit-add="false"
                    v-for="(person, index) in salesOrder.contractPeople"
                    :key="index"
                    :person="person"
                >
                </personCard>
            </div>
        </div>
     </div>
</template>

<script>
    import personCard from './personCard';
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: 'SalesOrdersPeoplePanel',

        components: {
            personCard
        },

        computed: {
            ...mapGetters(['salesOrder', 'isAddingPersonViewOpen'])
        },

        methods: {
            ...mapActions(['showAddPersonCard'])
        },
    }
</script>

<style lang="sass" scoped>
.panel-body 
    margin-top: 1em    
    .cards 
        margin-top: 1em

    .panel-body
        padding: 2em 1em
</style>