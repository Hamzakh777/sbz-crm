// todos module
// this is where we put our state, getters, actions, mutations,...
// the following is a boilerplate for a vuex module
import axios from 'axios';

const namespaced = true;

const state = {
    tasksCollection: {
        name: null,
        id: null,
        tasks: []
    }
};

// in order to get the state and be able to display it on our component we need to add a getter
const getters = {
    allTodos(state) { return state.tasksCollection.tasks; },
    tasksCollection(state) { return state.tasksCollection; }
};

// make a request, get a reponse and make a mutations
const actions = {
    async fetchTodos({ commit }) {
        const response = await axios.get('https://jsonplaceholder.typicode.com/todos');

        commit('setTodos', response.data);
    },
    async addTodo({ commit }, data) {
        // const response = await axios.post('https://jsonplaceholder.typicode.com/todos', { title, completed: false });

        commit('newTodo', data);
    },
    async deleteTodo({ commit }, index) {
        // since we are not going to use the response in any way
        // it makes sense not storing it in a variable
        // await axios.delete(`https://jsonplaceholder.typicode.com/todos/${id}`);

        // deleteTodo from array by its index
        commit('deleteTodo', index);
    },
    async updateTodo({ commit }, updTodo) {
        const response = await axios.put(`https://jsonplaceholder.typicode.com/todos/${updTodo.id}`, updTodo);

        commit('updateTodo', response.data);
    },
    async storeCollection({ commit }) {
        const response = await axios.post('/api/tasks-collections', state.tasksCollection);
        console.log(response);
    }
};

const mutations = {
    setTodos(state, task) {
        state.tasksCollection.tasks = task;
    },
    newTodo(state, task) {
        state.tasksCollection.tasks.unshift(JSON.parse(JSON.stringify(task)))
    },
    deleteTodo(state, eltIndex) {
        // state.todos = state.todos.filter(todo => todo.id !== id);
        state.tasksCollection.tasks = state.tasksCollection.tasks.filter((todo, index) => index !== eltIndex);
    },
    updateTodo(state, updTodo) {
        const index = state.tasksCollection.tasks.findIndex(todo => todo.id == updTodo.id);
        if (index != -1) {
            state.tasksCollection.tasks.splide(index, 1, updTodo);
        }
    }
};

export default {
    namespaced,
    state,
    getters,
    actions,
    mutations
};