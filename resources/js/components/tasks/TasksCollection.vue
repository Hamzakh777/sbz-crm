<template>
	<div class="panel panel-bordered panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title panel-icon"><i class="voyager-search"></i>{{ trans.get('voyager.tasks.tasks') }}</h3>
			<div class="panel-actions">
				<a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
			</div>
		</div>
		<div class="panel-body">
			<div class="row row--collection">
				<h4>{{ trans.get('voyager.tasks_collection.tasks_collection') }}</h4>
				<div class="row">
					<form @submit.prevent="storeCollection">
						<div class="form-group col-md-12">
						<label class="control-label">{{ trans.get('voyager.generic.name') }}</label>
						<input type="text" v-model="tasksCollection.name" class="form-control" />
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
			<div v-if="!isCollectionSaved">
				<hr>
				<div class="row">
					<add-task></add-task>

					<todos></todos>
				</div>
			</div>
		</div>
		<!-- we can save the task collection even if it doesn't have any tasks yet -->
		<div class="panel-footer" v-if="!isCollectionSaved">
			<button 
				class="btn btn-primary"
				@click="storeCollection"
			>
				{{ trans.get('voyager.generic.save') }}
			</button>
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
			if(this.tasksCollection.id == null) {
				return true;
			} else { 
				return false;
			}
		},
		
		/**
		 * We want to fire different actions
		 * and show relativly different views 
		 * depending on wether we are adding or 
		 * editing an existing collection
		 * @var {Boolean}
		 */
		idAdding() {
			if(this.tasksCollection.id === undefined || this.tasksCollection.id === null) {
				return true;
			} else {
				return false;
			}
		}
	},

	methods: {
		...mapActions('tasks', ['storeCollection', 'fetchTasks'])
	},

	created() {
		if(!this.isAdding) {
			this.fetchTasks();
		}
	}
};
</script>

<style lang="sass" scoped>
.panel 
	.row
		&--collection 
			margin-bottom: 2em
	h4 
		color: #555
</style>