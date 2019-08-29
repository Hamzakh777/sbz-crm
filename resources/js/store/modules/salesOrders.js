import salesOrdersPeople from './salesOrdersPeople';

const state = {
    filterData: {},
    isLoading: false,
    salesOrder: {
        id: (window.salesOrderId === null) ? null : window.salesOrderId,
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
        contractDurationVVG: 60,
        contractDurationKVG: 60,
        contractStartVVG: null,
        contractStartKVG: null,
        insuranceTrackingID: null,
        insuranceSubmittedDate: null,
        provisionDone: null,
        cancellationOriginal: null,
        cancellationStamped: null,
        tasksCollectionId: null,
        documents: [],
        comments: [],
        people: [],
    },
    contractPersonDetails: {
        firstName: null,
        lastName: null,
        gender: null,
        birthday: null,
        age: null,
        familyMemberType: null,
        policeNumber: null,
        selectedProduct: null,
        products: []
    },
    insurances: window.insurances !== undefined ? window.insurances : null,
    salesAgents: window.salesAgents !== undefined ? window.salesAgents : null,
    products: window.products !== undefined ? window.products : null,
    productCategories: window.productCategories !== undefined ? window.productCategories : null,
    users: window.users !== undefined ? window.users : null,
    tasksCollections: window.tasksCollections !== undefined ? window.tasksCollections : null,
    dateFormat: "dd MM yyyy"
};

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
    /**
     * 
     * @param {Object} state 
     */
    isAddingPersonViewOpen(state) {
        return state.isAddingPersonViewOpen;
    },

    /**
     * 
     * @param {Object} state 
     */
    contractPersonDetails(state) {
        return state.contractPersonDetails;
    },
    /**
     * 
     * @param {Object} state 
     */
    allProducts(state) {
        return state.products;
    },

    /**
     * 
     * @param {Object} state 
     */
    allProductCategories(state) {
        return state.productCategories;
    },

    /**
     * 
     * @param {Object} state 
     */
    users(state) {
        return state.users;
    },

    /**
     * 
     * @param {Object} state 
     */
    allTasksCollections(state) {
        return state.tasksCollections;
    },

    isLoading(state) {
        return state.isLoading;
    }
};

const actions = {
    /**
     * Get all the sales orders
     * @param {*} param0
     */
    async fetchSalesOrder({ state, commit }) {
        this.isLoading = true;
        try {
            const response = await axios.get(`/api/sales-orders/${state.salesOrder.id}`);

            this.isLoading = false;
            commit("setSalesOrder", response.data.salesOrder);
        } catch (error) {
            this.isLoading = false;
            console.error(error);
        }
    },

    async storeSalesOrder({state, commit}) {
        this.isLoading = true;
        try { 
            const response = await axios.post('/api/sales-orders', state.salesOrder);
            
            this.isLoading = false;
            commit('setSalesOrderId', response.data.id);
        } catch(error) {
            this.isLoading = false;
            console.error(error);
        }
    },

    async updateSalesOrder({state}) {
        this.isLoading = true;
        try {
            await axios.put(`/api/sales-orders/${state.salesOrder.id}`, state.salesOrder);

            this.isLoading = false;
        } catch (error) {
            this.isLoading = false;
            console.error(error);
        }
    },

    /**
     * Update the pagination page
     * @param {*} param0
     * @param {Number} page
     */
    async changePaginationPage({ commit }, page = 1) {
        try {
            const response = await axios.post(
                `/sales-orders/filter?page=${page}`,
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

};

const mutations = {
    setSalesOrder(state, data) {
        // state.salesOrders = data;
        state.salesOrder.documents = data.documents;
        state.salesOrder.people = data.people;
        state.salesOrder.comments = data.comments;
        state.salesOrder.taskCollectionId = data.taskCollectionId;
    },
    setSalesOrderId(state,data){
        state.salesOrder.id = data;
    },
    setContractPerson(state, data) {
        state.salesOrder.contractPeople.push(data);
    }
};

export default {
    modules: {
        salesOrdersPeople
    },
    state,
    getters,
    actions,
    mutations
};
