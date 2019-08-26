<template>
     <div class="panel panel-primary panelbordered">
        <div class="panel-heading">
            <h3 class="panel-title panel-icon"><i class="voyager-people"></i>{{ trans.get('voyager.generic.people') }}</h3>
            <div class="panel-actions">
                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
            </div>
        </div>
        <div class="panel-body mt-2">
            <div class="row cards">
                <BaseLoader
                    v-if="isLoading"
                >
                </BaseLoader>
                <!-- the form to add or edit a contract person -->
                <personFrom></personFrom>
                <!-- for viewing already added contract people -->
                <personCard 
                    v-for="(person, index) in allPeople"
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
    import personFrom from './personForm';
    import BaseLoader from '../../../baseComponents/BaseLoader';
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: 'SalesOrdersPeoplePanel',

        components: {
            personCard,
            personFrom,
            BaseLoader
        },

        computed: {
            ...mapGetters('salesOrdersPeople', ['allPeople', 'isLoading'])
        }
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