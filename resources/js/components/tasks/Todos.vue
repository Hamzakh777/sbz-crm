<template>
    <div class="todos">
        <hr>
        <div>
            <!-- <div v-for="(todo, index) in allTodos" :key="index" @dblclick="onDoubleClick(todo)" :class="{'is-complete': todo.complete, todo}">
                <div @click="deleteTodo(todo.id)" class="fas fa-trash"></div> 
            </div> -->
            <TaskCard
                v-for="(task, index) in allTodos"
                :key="index"
                :task="task"
            >
            </TaskCard>
        </div> 
    </div>
</template>

<script>
import { mapGetters , mapActions } from 'vuex';
import TaskCard from './TaskCard';

export default {
    name: 'Todos',

    components: {
        TaskCard
    },
    
    computed: {
        ...mapGetters('tasks', ['allTodos'])
    },
    // we need to call the actions, to do that we first have to add them to our methodes

    methods: {
        ...mapActions('tasks' ,['fetchTodos', 'deleteTodo', 'updateTodo']),

        onDoubleClick(todo) {
            const updTodo = {
                id: todo.id,
                title: todo.title,
                completed: !todo.completed
            };

            this.updateTodo(updTodo);
        }
    },

    // we call the action when the component is created
    created() {
        // this.fetchTodos();
    },

    
};
// we need to call the fetch todos action
/*
if we were only to have actions as methodes we can do the following 
methodes: getActions(['fetchTodos'])
*/
</script>

<style scoped lang="sass">
.todos 
    margin-top: 2em
h4 
    color: #555
</style>
