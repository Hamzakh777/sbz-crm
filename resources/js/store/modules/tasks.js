// todos module
// this is where we put our state, getters, actions, mutations,...
// the following is a boilerplate for a vuex module
import axios from 'axios';

const namespaced = true;

const state = {
    tasksCollection: {
        name: null,
        id: (window.collectionId !== undefined) ? window.collectionId : null,
        tasks: []
    }
};

const getters = {
    allTodos(state) { return state.tasksCollection.tasks; },
    tasksCollection(state) { return state.tasksCollection; }
};


const actions = {
    async fetchTasks({ commit }) {
        const url = `/api/tasks-collections/${state.tasksCollection.id}`;
        const response = await axios.get(url);

        console.log(response);
        commit('setTasksCollection', response.data);
    },

    async addTask({ commit }, taskData) {
        const data = taskData;
        // each task needs to have the collection id it belongs to
        data.tasksCollectionId = state.tasksCollection.id;
        const response = await axios.post('/api/tasks', data);

        commit('newTodo', response.data);
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
        // collection doesnt exists
        if (state.tasksCollection.id === undefined || state.tasksCollection.id === null) {
            const response = await axios.post('/api/tasks-collections', state.tasksCollection);

            commit('setTasksCollection', response.data);
        } 
        // collection already exists 
        else {
            const url = `/api/tasks-collections/${state.tasksCollection.id}`;
            const data = {
                name: state.tasksCollection.name
            };

            const response = await axios.put(url, data);

            commit('setTasksCollection', response.data);
        }
    }
};

const mutations = {
    setTasksCollection(state, data) {
        state.tasksCollection.name = data.tasksCollection.name;
        state.tasksCollection.id = data.tasksCollection.id;
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