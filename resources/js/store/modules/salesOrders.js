
const state = {
    salesOrders: [],
};

// in order to get the state and be able to display it on our component we need to add a getter
const getters = {
    allSalesOrders(state) { return state; },
};

// make a request, get a reponse and make a mutations
const actions = {
    /**
     * Get all the sales orders
     * @param {*} param0 
     */
    async fetchSalesOrders({ commit }) {
        try {
            const response = await axios.post('sales-orders-api');
            
            commit('setSalesOrders', response.data.salesOrders);
        } catch (error) {
            
        }
    },

};

// mutations is how we mutate the state
const mutations = {
    setSalesOrders(state, data) {
        state.salesOrders = data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations
};