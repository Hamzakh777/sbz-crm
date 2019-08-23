<template>
    <BasePanel :showFooter="false" :name="'voyager.tasks.tasks'" icon="voyager-list">
        <template v-slot:body>
            <h4 class="title">{{ trans.get('voyager.sales_orders.select_tasks_collection') }}</h4>
            <div class="row">
                <form class="col-md-12">
                    <div class="form-group row">
                        <select 
                            class="form-control"
                            v-model="salesOrder.taskCollectionId"
                        >
                            <option value="">{{ trans.get('voyager.sales_orders.new_tasks_collection') }}</option>
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
            </div>
            <hr v-if="isTasksCollectionAlreadySelected">
            <div class="row" v-if="isTasksCollectionAlreadySelected">
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
// 

    import {mapGetters, mapActions} from 'vuex';
    import BasePanel from '../../baseComponents/BasePanel';
    import TasksCollection from '../../tasks/TasksCollection';

    export default {
        name: 'SalesOrdresTasks',

        components: {
            BasePanel,
            TasksCollection
        },

        computed: {
            ...mapGetters(['salesOrder', 'allTasksCollections']),
            ...mapGetters('tasks', ['tasksCollection']),

            isTasksCollectionAlreadySelected() {
                if(this.salesOrder.taskCollectionId !== null && this.salesOrder.taskCollectionId !== "") {
                    this.tasksCollection.id = this.salesOrder.taskCollectionId;
                    // whenever the selected collection changes, we need to fetch the data
                    // corresponding to that collection
                    this.fetchTasks();
                    return true;
                } else {
                    return false;
                }
            }
        },

        data() {
            return { 
                tasksCollectionId: this.tasksCollection
            }
        },

        methods: {
            ...mapActions('tasks', ['fetchTasks'])
        }
    }
</script>

<style lang="sass" scoped>

</style>