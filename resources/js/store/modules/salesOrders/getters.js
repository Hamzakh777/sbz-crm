
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

    loader(state) {
        return state.showContractLoader;
    }
}

export default getters;