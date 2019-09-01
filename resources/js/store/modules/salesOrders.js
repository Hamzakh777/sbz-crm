import salesOrdersPeople from './salesOrdersPeople';

const state = {
    filterData: {},
    Loading: false,
    salesOrder: {
        id: (window.salesOrderId === null) ? null : window.salesOrderId,
        currentInsuranceId: null,
        newInsuranceId: null,
        fullName: null,
        address: null,
        householdType: null,
        numberOfFamilyMembers: null,
        newBorn: false,
        moveToSwitzerland: false,
        salesLeadSource: null,
        salesPersonId: null,
        signDate: null,
        salesOrderStatus: null,
        insuranceStatus: null,
        contractDurationVVG: '60',
        contractDurationKVG: '60',
        contractStartVVG: null,
        contractStartKVG: null,
        insuranceTrackingID: null,
        insuranceSubmittedDate: null,
        // checkpoint details
        provisionDone: false,
        cancellationOriginal: false,
        cancellationStamped: false,
        // extras 
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
    tasksCollections: window.tasksCo1llections !== undefined ? window.tasksCollections : null,
    salesOrders: window.salesOrders !== undefined ? window.salesOrders : null,
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

    Loading(state) {
        return state.Loading;
    }
};

const actions = {
    /**
     * Get all the sales orders
     * @param {*} param0
     */
    async fetchSalesOrder({ state, commit }) {
        state.Loading = true;
        try {
            const response = await axios.get(`/api/sales-orders/${state.salesOrder.id}`);
            
            state.Loading = false;
            commit("setSalesOrder", response.data.salesOrder);
        } catch (error) {
            state.Loading = false;
            console.error(error);
        }
    },

    async storeSalesOrder({state, commit}) {
        state.Loading = true;
        try { 
            const response = await axios.post('/api/sales-orders', state.salesOrder);
            
            state.Loading = false;
            commit('setSalesOrderId', response.data.id);
        } catch(error) {
            this.Loading = false;
            console.error(error);
        }
    },

    async updateSalesOrder({state}) {
        state.Loading = true;
        try {
            await axios.put(`/api/sales-orders/${state.salesOrder.id}`, state.salesOrder);

            state.Loading = false;
        } catch (error) {
            state.Loading = false;
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

        // customer details
        state.salesOrder.currentInsuranceId = data.current_insurance_id;
        state.salesOrder.fullName = data.owner_full_name;
        state.salesOrder.address = data.owner_address;
        state.salesOrder.householdType = data.owner_household_type;
        state.salesOrder.newBorn = data.new_born === 1 ? true : false;
        state.salesOrder.moveToSwitzerland = data.move_to_switzerland === 1 ? true : false;
        
        // sales details
        state.salesOrder.salesLeadSource = data.sales_lead_source
        state.salesOrder.salesPersonId = data.sales_user_id;
        state.salesOrder.signDate = data.contract_sign_date;
        
        // contract details
        state.salesOrder.salesOrderStatus = data.sales_order_status;
        state.salesOrder.newInsuranceId = data.new_insurance_id;
        state.salesOrder.insuranceStatus = data.insurance_status;
        
        // Insurance details
        state.salesOrder.contractDurationVVG = data.contract_duration_VVG;
        state.salesOrder.contractDurationKVG = data.contract_duration_KVG;
        state.salesOrder.contractStartVVG = data.contract_start_VVG;
        state.salesOrder.contractStartKVG = data.contract_start_KVG;
        state.salesOrder.insuranceTrackingID = data.insurance_tracking_id;

        // system details
        state.salesOrder.insuranceSubmittedDate = data.insurance_submitted_date;

        // checkpoint details
        state.salesOrder.cancellationOriginal = data.cancellation_original === 1 ? true : false;
        state.salesOrder.cancellationStamped = data.cancellation_stamped === 1 ? true : false;
        state.salesOrder.provisionDone = data.provision_done === 1 ? true : false;

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
