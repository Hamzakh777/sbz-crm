<template>
	<div>
		<div class="row row--collection">
			<h4>{{ trans.get('voyager.tasks_collection.tasks_collection') }}</h4>
			<div class="row">
				<form @submit.prevent="submit">
					<div class="form-group col-md-12">
						<label class="control-label">{{ trans.get('voyager.generic.name') }}</label>
						<input type="text" v-model="tasksCollection.name" class="form-control" />
						<div v-if="$v.tasksCollection.name.$dirty">
                            <span class="error-text" v-if="!$v.tasksCollection.name.required">
                                {{ trans.get('validation_js.required') }}
                            </span>
                        </div>
					</div>
					<div class="form-group col-md-12">
						<button 
							class="btn btn-primary pull-right"
							type="submit"
						>
							<span>{{ trans.get('voyager.generic.save') }}</span>
						</button>
					</div>
				</form>
			</div>
		</div>
		<div v-if="isCollectionSaved">
			<hr>
			<div class="row">
				<add-task></add-task>
				<todos></todos>
			</div>
		</div>
	</div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';

import Todos from "./Todos.vue";
import AddTask from "./AddTask";
import { required } from 'vuelidate/lib/validators';

export default {
	name: "TasksCollection",

	components: {
		Todos,
		AddTask
	},

	computed: {
		...mapGetters('tasks', ['tasksCollection']),

		/**
		 * @var {Boolean}
		 */
		isCollectionSaved() {
			if(this.tasksCollection.id === null || this.tasksCollection.id === "" ) {
				return false;
			} else { 
				return true;
			}
		}
	},

	validations: {
		tasksCollection: {
			name: {
				required
			}
		}
	},

	methods: {
		...mapActions('tasks', ['storeCollection', 'fetchTasks']),

		submit() {
			
			this.$v.$touch();
                if(this.$v.$invalid) {
                    console.log('not validated yet')
                } else {
                    this.storeCollection();
                }
		}
	},

	created() {
		if(this.tasksCollection.id !== null && this.tasksCollection.id !== "" ) {
			this.fetchTasks();
		}
	}
};
</script>

<style lang="sass" scoped>

.row
	&--collection 
		margin-bottom: 2em
h4 
	color: #344055
</style>