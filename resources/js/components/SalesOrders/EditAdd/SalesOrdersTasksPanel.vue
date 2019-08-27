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
                        v-model="salesOrder.taskCollectionId"
                    >
                        <!-- <option value="">{{ trans.get('voyager.sales_orders.new_tasks_collection') }}</option> -->
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
// we want to check if the sales order has an task_collection_id
// if yes, we use the task_collection_id and set the id in the tasks collection store
// that will automatically triger loading the content

// we also need to show a drop down to select another collection
// when changed
// change task_collection_id

// we gonna use a switch button to toggle between choosing an existing 
// tasks collection and creating a new one

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
                    this.tasksCollection.id = this.salesOrder.taskCollectionId = null;
                    // empty the tasks collection name field
                    this.tasksCollection.name = null;
                }
            },

            // we need to watch the taskscollection id
            
            'tasksCollection.id': function(newVal, oldVal) {
                this.salesOrder.tasksCollectionId = newVal;
                this.updateSalesOrder();
            },

            'salesOrder.taskCollectionId': function(newVal, oldVal) {
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
                    if(this.salesOrder.taskCollectionId !== null ) {
                        this.tasksCollection.id = this.salesOrder.taskCollectionId;
                        // whenever the selected collection changes, we need to fetch the data
                        // corresponding to that collection
                        this.fetchTasks();
                        return true;
                    }
                } else { 
                    // we need to m
                    return false;
                }
            }
        },

        data() {
            return { 
                /**
                 * Determine if we are choosing an 
                 * exising tasks collection or 
                 * creating a new one
                 * @var {Boolean}
                 */
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