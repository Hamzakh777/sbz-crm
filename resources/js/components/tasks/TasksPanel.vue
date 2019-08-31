<template>
    <BasePanel 
        :show-footer="!isCollectionSaved"
        name="voyager.tasks.tasks"
        icon="voyager-list"
        >
		<template v-slot:body>
            <TasksCollection></TasksCollection>
		</template>
		<!-- we can save the task collection even if it doesn't have any tasks yet -->
		<template v-slot:footer v-if="!isCollectionSaved">
			<a
			 	href="/tasks-collections/"
				class="btn btn-primary"
			>
				{{ trans.get('voyager.generic.close') }}
			</a>
		</template>
	</BasePanel>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    import BasePanel from '../baseComponents/BasePanel';
    import TasksCollection from './TasksCollection';

    export default {
        name: 'TasksPanel',

        components: { 
            BasePanel,
            TasksCollection
        },

        methods: {
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
            }
        }

    }
</script>

<style lang="scss" scoped>

</style>