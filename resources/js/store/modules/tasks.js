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
    },
    isLoading: false
};

const getters = {
    allTodos(state) { return state.tasksCollection.tasks; },
    tasksCollection(state) { return state.tasksCollection; },
    isLoading(state) { return state.isLoading; }
};


const actions = {
    async fetchTasks({ commit }) {
        this.isLoading = true
        try {
            const url = `/api/tasks-collections/${state.tasksCollection.id}`;
            const response = await axios.get(url);
    
            this.isLoading = false;
            commit('setTasksCollection', response.data);
        } catch(e) {
            this.isLoading = false;
            alert(e);
        }  
    },

    async addTask({ commit }, taskData) {
        this.isLoading = true;
        try {
            const data = taskData;
            // each task needs to have the collection id it belongs to
            data.tasksCollectionId = state.tasksCollection.id;
            const response = await axios.post('/api/tasks', data);
    
            commit('newTask', response.data.task);
        } catch (error) {
            this.isLoading = false
            alert(error);
        }
    },

    async deleteTask({ commit }, id) {
        const url = `/api/tasks/${id}`;
        await axios.delete(url);

        commit('deleteTask', id);
    },

    async updateTask({ commit }, updTask) {
        const url = `/api/tasks/${updTask.id}`;
        const response = await axios.put(url, updTask);

        commit('updateTask', response.data);
    },

    async storeCollection({ commit }) {
        // collection doesnt exists
        if (state.tasksCollection.id === undefined || state.tasksCollection.id === null || state.tasksCollection.id === "") {
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
        if(data.tasks !== undefined) {
            state.tasksCollection.tasks = data.tasks;
        }
    },
    setTasksCollectionId(state, id) {
        state.tasksCollection.id = id;
    },
    newTask(state, task) {
        state.tasksCollection.tasks.unshift(JSON.parse(JSON.stringify(task)));
    },
    deleteTask(state, id) {
        state.tasksCollection.tasks = state.tasksCollection.tasks.filter((task, index) => task.id !== id);
    },
    updateTask(state, updTodo) {
        const index = state.tasksCollection.tasks.findIndex(task => task.id == updTodo.id);
        if (index != -1) {
            state.tasksCollection.tasks.splice(index, 1, updTodo);
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