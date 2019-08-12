
const state = {
    salesOrders: [],
};

// in order to get the state and be able to display it on our component we need to add a getter
const getters = {
    allSalesOrders(state) { return state; },
};

// make a request, get a reponse and make a mutations
const actions = {
    async fetchSalesOrders({ commit }) {
        const response = await axios.get('https://jsonplaceholder.typicode.com/todos');

        commit('setTodos', response.data);
    },
};

// mutations is how we mutate the state
const mutations = {
    setSalesOrders(state, salesOrders) {
        state.salesOrders = salesOrders;
    },
};