const state = {
    salesOrders: {},
    filterData: {}
};

// in order to get the state and be able to display it on our component we need to add a getter
const getters = {
    allSalesOrders(state) {
        // since the paginator needs the whole collection
        // we return it
        return state.salesOrders;
    }
};

// make a request, get a reponse and make a mutations
const actions = {
    /**
     * Get all the sales orders
     * @param {*} param0
     */
    async fetchSalesOrders({ commit }) {
        try {
            const response = await axios.post("sales-orders-api");

            commit("setSalesOrders", response.data.salesOrders);
        } catch (error) {}
    },

    /**
     * Update the pagination page
     * @param {*} param0
     * @param {Number} page
     */
    async changePaginationPage({ commit }, page = 1) {
        try {
            const response = await axios.post(
                `sales-orders/filter?page=${page}`,
                state.filterData
            );

            // the table is rendered in the backend
            // we send it over and display it on the frontend
            const table = document.querySelector("#table-wrapper");
            table.innerHTML = response.data.table;

            // update the paginator
            commit("setSalesOrders", response.data.dataTypeContent);
        } catch (error) {
            alert(error);
        }
    },

    /**
     * Filter sales orders
     * we runder the view in the backend
     * reason for such a decision is to save dev time
     * @param {*} param0
     * @param {Object} data
     */
    async filterSalesOrders({ commit }, data, page = 1) {
        try {
            // update the filter data
            state.filterData = data;

            const response = await axios.post(
                `sales-orders/filter?page=${page}`,
                data
            );

            // the table is rendered in the backend
            // we send it over and display it on the frontend
            const table = document.querySelector("#table-wrapper");
            table.innerHTML = response.data.table;

            // update the paginator
            commit("setSalesOrders", response.data.dataTypeContent);
        } catch (error) {
            console.warn(error);
        }
    }
};

// mutations is how we mutate the state
const mutations = {
    setSalesOrders(state, data) {
        state.salesOrders = data;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
