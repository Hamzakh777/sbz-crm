<template>
    <div >
        <h4 class="title">{{ trans.get('voyager.tasks.add_task') }}</h4>
        <div class="row">
            <form @submit.prevent="onSubmit" class="row"> 
                <!-- name -->
                <div class="form-group col-md-3">
                    <label class="control-label">
                        {{ trans.get('voyager.generic.name') }}
                    </label>
                    <input  class="form-control" type="text" v-model="name">
                </div>

                <!-- owner -->
                <div class="form-group col-md-3">
                    <label class="control-label">
                        {{ trans.get('voyager.tasks.task_owner') }}
                    </label>
                    <select 
                        class="form-control"
                        v-model="taskOwnerId"
                    >
                        <option 
                            v-for="(agent, index) in allSalesAgents"
                            :value="agent.id"
                            :key="index"    
                        >
                            {{ agent.username }}
                        </option>
                    </select>
                </div>

                <!-- date -->
                <div class="form-group col-md-3">
                    <label class="control-label">
                        {{ trans.get('voyager.generic.date') }}
                    </label>
                    <Datepicker
                        class="datePicker"
                        input-class="form-control"
                        v-model="date"
                        :format="DateFormat"
                    ></Datepicker>
                </div>

                <!-- status -->
                <div class="form-group col-md-3">
                    <label class="control-label">
                        {{ trans.get('voyager.generic.status') }}
                    </label>
                    <select 
                        class="form-control"
                        v-model="status"
                    >
                        <option value="status1">status1</option>
                        <option value="status2">status2</option>
                    </select>
                </div>

                <div class="row">
                    <input type="submit" :value="trans.get('voyager.generic.add')" class="btn btn-primary pull-right">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters} from 'vuex';
import Datepicker from "vuejs-datepicker";

export default {
    name: 'AddTask',

    components: {
        Datepicker
    },
    
    data() {
        return {
            name: null,
            taskOwnerId: null,
            date: null,
            status: null,
            completed: 0,
        }
    },

    computed: {
        ...mapGetters(['allSalesAgents', 'DateFormat'])
    },

    methods: {
        ...mapActions('tasks',['addTodo']),

        /**
         * Add the todo and 
         * clear the form
         */
        onSubmit() {
            this.addTodo(this.$data);

            this.name = null;
            this.taskOwnerId = null;
            this.date = null;
            this.status = null;
        },
    }

}
</script>

<style scoped lang="sass">
 
.title 
    margin-bottom: 0.5em
    color: #555
    
.form-control[readonly]
    background-color: #fff
</style>
