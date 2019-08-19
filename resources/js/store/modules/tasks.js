// todos module
// this is where we put our state, getters, actions, mutations,...
// the following is a boilerplate for a vuex module
import axios from 'axios';

const state = {
    todos: []
};

// in order to get the state and be able to display it on our component we need to add a getter
const getters = {
    allTodos(state) { return state.todos; },
};

// make a request, get a reponse and make a mutations
const actions = {
    async fetchTodos({ commit }) {
        const response = await axios.get('https://jsonplaceholder.typicode.com/todos');

        commit('setTodos', response.data);
    },
    async addTodo({ commit }, title) {
        const response = await axios.post('https://jsonplaceholder.typicode.com/todos', { title, completed: false });

        commit('newTodo', response.data);
    },
    async deleteTodo({ commit }, id) {
        // since we are not going to use the response in any way
        // it makes sense not storing it in a variable
        await axios.delete(`https://jsonplaceholder.typicode.com/todos/${id}`);

        commit('deleteTodo', id);
    },
    async filterTodos({ commit }, e) {
        // get selected number
        const limit = e.target.value;

        const response = await axios.get(`https://jsonplaceholder.typicode.com/todos?_limit=${limit}`);

        commit('setTodos', response.data);
    },
    async updateTodo({ commit }, updTodo) {
        const response = await axios.put(`https://jsonplaceholder.typicode.com/todos/${updTodo.id}`, updTodo);

        commit('updateTodo', response.data);
    }
};

const mutations = {
    setTodos(state, todos) {
        state.todos = todos;
    },
    newTodo(state, todo) {
        state.todos.unshift(todo);
    },
    deleteTodo(state, id) {
        state.todos = state.todos.filter(todo => todo.id !== id);
    },
    updateTodo(state, updTodo) {
        const index = state.todos.findIndex(todo => todo.id == updTodo.id);
        if (index != -1) {
            state.todos.splide(index, 1, updTodo);
        }
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};