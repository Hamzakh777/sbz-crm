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
                        v-model="id"
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
            <hr v-if="showTasks">
            <div class="row" v-if="showTasks">
                <TasksCollection></TasksCollection>
            </div>
        </template>
    </BasePanel>
</template>

<script>
    import {mapGetters, mapActions, mapMutations} from 'vuex';
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
            isExistingTasksCollection(newVal, oldVal) {
                this.id = null;
                this.tasksCollection.name = null;

                this.updSalesTasksCollec(this.id);
                 if(this.id !== null && this.isExistingTasksCollection === true) { // selected an existing tasks collection
                    this.showTasks = true;
                    this.fetchTasks();
                } else if(this.id === null && this.isExistingTasksCollection === true) { // didnt select an existing tasks collection yet
                    this.showTasks = false;
                } else { // create a new task
                    this.showTasks = true;
                }
            },

            id(newVal, oldVal) {
                this.setTasksCollectionId(newVal);
                this.updSalesTasksCollec(newVal);
                if(this.id !== null && this.isExistingTasksCollection === true) { // selected an existing tasks collection
                    this.showTasks = true;
                    this.fetchTasks();
                } else if(this.id === null && this.isExistingTasksCollection === true) { // didnt select an existing tasks collection yet
                    this.showTasks = false;
                } else { // create a new task
                    this.showTasks = true;
                }
            },

            'tasksCollection.id': function(newVal, oldVal) {
                if(newVal !== null) {
                    this.id = newVal;
                    this.updSalesTasksCollec(newVal);
                }

            }
        },


        computed: {
            ...mapGetters(['salesOrder', 'allTasksCollections']),
            ...mapGetters('tasks', ['tasksCollection']),
        },

        data() {
            return { 
                isExistingTasksCollection: true,
                showTasks: false,
                id: null,
            }
        },

        methods: {
            ...mapActions('tasks', ['fetchTasks']),
            ...mapActions(['updateSalesOrder']),
            ...mapMutations('tasks',['setTasksCollectionId']),

            async updSalesTasksCollec(id) {
                try {
                    if(id === null) {
                        const url = `/api/sales-orders/${this.salesOrder.id}/tasks-collections`;
                        await axios.put(url);
                    } else {
                        const url = `/api/sales-orders/${this.salesOrder.id}/tasks-collections/${id}`;
                        await axios.put(url);
                    }
                } catch(e) {
                    alert(e);
                }
            },

            async fetchSalesTaskCollec() {
                try {
                    const url = `/api/sales-orders/${this.salesOrder.id}/tasks-collections`;

                    const response = await axios.get(url);

                    this.id = response.data.tasksCollectionId;
                } catch(e) {
                    alert(e);
                }
            }
        },

        mounted() {
            this.fetchSalesTaskCollec();
        }
    }
</script>

<style lang="sass" scoped>
.vue-js-switch
    margin-top: 0.25em
    margin-left: 0.5em
</style>