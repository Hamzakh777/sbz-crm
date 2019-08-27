<template>
    <BasePanel :showFooter="false" :name="'voyager.tasks.tasks'" icon="voyager-list">
        <template v-slot:body>
            <h4 class="title">{{ trans.get('voyager.sales_orders.select_tasks_collection') }}</h4>
            <form class="row">
                <div class="from-group col-md-2">
                    <label class="control-label">
                        {{ trans.get('voyager.sales_orders.existing_tasks_collections') }}
                    </label>
                    <toggle-button
                        v-model="isExistingTasksCollection"
                        :value="true"
                        :labels="{checked: trans.get('voyager.generic.yes'), unchecked: trans.get('voyager.generic.no')}"
                    />
                </div>
                <div class="form-group col-md-10" v-if="isExistingTasksCollection">
                    <select 
                        class="form-control col-md-12"
                        v-model="salesOrder.tasksCollectionId"
                    >
                        <option 
                            v-for="collection in allTasksCollections"
                            :value="collection.id"
                            :key="collection.id"
                        >
                            {{ collection.name }}
                        </option>
                    </select>
                </div>
            </form>
            <hr v-if="showTasksForm ">
            <div class="row" v-if="showTasksForm">
                <TasksCollection></TasksCollection>
            </div>
        </template>
    </BasePanel>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import BasePanel from '../../baseComponents/BasePanel';
    import TasksCollection from '../../tasks/TasksCollection';
    import { ToggleButton } from "vue-js-toggle-button";

    export default {
        name: 'SalesOrdresTasks',

        components: {
            BasePanel,
            TasksCollection,
            ToggleButton
        },

        watch: {
            isExistingTasksCollection(val, oldVal) {
                if(val === false) {
                    // reset the selected collection
                    this.tasksCollection.id = null;
                    this.salesOrder.tasksCollectionId = null;
                    this.tasksCollection.name = null;
                    this.updateSalesOrder();
                }
            },

            'tasksCollection.id': function(newVal, oldVal) {
                this.salesOrder.tasksCollectionId = newVal;
                this.updateSalesOrder();
            },

            'salesOrder.tasksCollectionId': function(newVal, oldVal) {
                if(this.tasksCollection.id === null && newVal !== null) {
                    this.tasksCollection.id = newVal;
                } 
            }
            
        },

        computed: {
            ...mapGetters(['salesOrder', 'allTasksCollections']),
            ...mapGetters('tasks', ['tasksCollection']),

            showTasksForm() {
                if(this.isExistingTasksCollection === true) {
                    if(this.salesOrder.tasksCollectionId !== null ) {
                        this.tasksCollection.id = this.salesOrder.tasksCollectionId;
                        // whenever the selected collection changes, we need to fetch the data
                        // corresponding to that collection
                        this.fetchTasks();
                        return true;
                    }
                } else { 
                    // we need to m
                    return true;
                }
            }
        },

        data() {
            return { 
                isExistingTasksCollection: true
            }
        },

        methods: {
            ...mapActions('tasks', ['fetchTasks']),
            ...mapActions(['updateSalesOrder'])
        }
    }
</script>

<style lang="sass" scoped>
.vue-js-switch
    margin-top: 0.25em
    margin-left: 0.5em
</style>