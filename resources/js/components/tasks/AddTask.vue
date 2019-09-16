<template>
    <div>
        <h4 class="title">{{ trans.get('voyager.tasks.add_task') }}</h4>
        <div class="row">
            <form @submit.prevent="onSubmit" class="row"> 
                <!-- name -->
                <div class="form-group col-md-3">
                    <label class="control-label">
                        {{ trans.get('voyager.generic.name') }}
                    </label>
                    <input  
                        class="form-control" 
                        type="text" 
                        v-model="name"
                        :class="{'form-control--error': $v.name.$error }"
                    >
                    <div v-if="$v.name.$error">
                        <span class="error-text" v-if="!$v.name.required">
                            {{ trans.get('validation_js.required') }}
                        </span>
                    </div>
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
                        <option value="">{{ trans.get('voyager.generic.none') }}</option>
                        <option 
                            v-for="(agent, index) in users"
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
                        <option value="open">{{ trans.get('voyager.generic.open') }}</option>
                        <option value="pending">{{ trans.get('voyager.generic.pending') }}</option>
                        <option value="closed">{{ trans.get('voyager.generic.closed') }}</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">
                            <span>{{ trans.get('voyager.generic.add') }}</span>
                        </button>
                        <button class="btn btn-light pull-right" @click.prevent="clearForm">
                            <i class="voyager-trash"></i>
                            <!-- clear filter -->
                            <span>{{ trans.get('voyager.generic.clear_form') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters} from 'vuex';
import Datepicker from "vuejs-datepicker";
import { required } from 'vuelidate/lib/validators';
export default {
    name: 'AddTask',

    components: {
        Datepicker
    },

    validations: {
        name: {
            required
        },
        status: {
            required
        }
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
        ...mapGetters(['users', 'DateFormat'])
    },

    methods: {
        ...mapActions('tasks',['addTask']),

        /**
         * Add the todo and 
         * clear the form
         */
        onSubmit() {
            this.addTask(this.$data);
        },

        clearForm() {
            this.name = null;
            this.taskOwnerId = null;
            this.date = null;
            this.status = null;
        }
    }

}
</script>

<style scoped lang="sass">

.form-control[readonly]
    background-color: #fff
</style>
