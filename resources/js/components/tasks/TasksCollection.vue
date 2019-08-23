<template>
	<div>
		<div class="row row--collection">
			<h4>{{ trans.get('voyager.tasks_collection.tasks_collection') }}</h4>
			<div class="row">
				<form @submit.prevent="storeCollection">
					<div class="form-group col-md-12">
						<label class="control-label">{{ trans.get('voyager.generic.name') }}</label>
						<input type="text" v-model="tasksCollection.name" class="form-control" />
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

	methods: {
		...mapActions('tasks', ['storeCollection', 'fetchTasks'])
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
	color: #555
</style>