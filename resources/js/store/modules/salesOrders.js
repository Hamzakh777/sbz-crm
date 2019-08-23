// switching between editing and adding will happen by a simple variable which will alter the
// behavior of some fuctions
// or
// it might not since the values of the person being edited will take the place of contractPersonDetails

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
        contractDurationVVG: 60,
        contractDurationKVG: 60,
        contractStartVVG: null,
        contractStartKVG: null,
        insuranceTrackingID: null,
        insuranceSubmittedDate: null,
        taskCollectionId: '',
        contractPeople: []
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
        } catch (error) {
            console.error(error);
        }
    },

    async storeSalesOrder({commit}) {
        try { 
            const response = await axios.post('/api/sales-orders', state.salesOrder);

            console.log(response);
        } catch(error) {
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
    addContractPerson({ commit }) {
        commit("setContractPerson", state.contractPersonDetails);
    },

    /**
     *
     */
    showAddPersonCard() {
        state.isAddingPersonViewOpen = true;
    },

    /**
     * Add a product to the contract person
     *
     */
    addProductToContractPerson() {
        // in order to prevent mutation of the original object
        const product = JSON.parse(
            JSON.stringify(state.contractPersonDetails.selectedProduct)
        );
        state.contractPersonDetails.products.push(product);
    },

    removeProduct({ commit }, id) {
        // if we have two or more of the same product
        // this will delete all of them
        const results = state.contractPersonDetails.products.filter(
            product => product.id !== id
        );
        state.contractPersonDetails.products = results;
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
