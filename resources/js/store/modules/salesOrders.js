const state = {
    // index page
    salesOrders: {},
    filterData: {},
    salesOrder: {
        currentInsuranceId: null,
        newInsuranceId: null,
        fullName: null,
        address: null,
        householdType: null,
        numberOfFamilyMembers: null,
        newBorn: null,
        moveToSwitzerland: null,
        salesLeadSource: null,
        salesPersonId: null,
        signDate: null,
        salesOrderStatus: null,
        insuranceStatus: null,
        contractDurationVVG: null,
        contractDurationKVG: null,
        insuranceTrackingID: null,
        contractPeople: []
    },
    insurances: (window.insurances !== undefined) ? window.insurances : '',
    salesAgents: (window.salesAgents !== undefined) ? window.salesAgents : '',
    isAddingPersonViewOpen: false,
    // global
    dateFormat: "dd MM yyyy"
};

// in order to get the state and be able to display it on our component we need to add a getter
const getters = {

    /**
     * Get all sales orders
     * Usually called on the
     * index page
     * @param {object} state 
     */
    allSalesOrders(state) {
        // since the paginator needs the whole collection
        // we return it
        return state.salesOrders;
    },

    /**
     * Get all insurances
     * @param {object} state 
     */
    allInsurances(state) {
        return state.insurances;
    },

    /**
     * Get all sales agents
     * @param {object} state 
     */
    allSalesAgents(state) {
        return state.salesAgents;
    },

    /**
     * return the date format to use across the app
     * @param {object} state
     */
    DateFormat(state) {
        return state.dateFormat;
    },

    /**
     * Return a single sales order,
     * usually to be used in the add-edit view
     * @param {object} state
     */
    salesOrder(state) {
        return state.salesOrder;
    },

    isAddingPersonViewOpen(state) {
        return state.isAddingPersonViewOpen;
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
    },

    /**
     * Add contract person to the 
     * sales order
     * @param {*} param0 
     * @param {object} data 
     */
    addContractPerson({commit}, data) {
        commit('setContractPerson', data);
    },

    /**
     * 
     */
    showAddPersonCard() {
        state.isAddingPersonViewOpen = true;
    }
};

// mutations is how we mutate the state
const mutations = {
    setSalesOrders(state, data) {
        state.salesOrders = data;
    },
    setContractPerson(state, data) {
        state.salesOrder.contractPeople.push(data);
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
