const getters = {
    isLoading(state) {
        return state.isLoading;
    },

    compensation(state) {
        return state.compensation;
    },

    salesOrderPeople(state, getters, rootState) {
        if(rootState.salesOrders.salesOrder.id !== null) {
            return state.compensation.salesOrder.people;
        } else {
            return rootState.salesOrders.salesOrder.people;
        }
    },

    totalExpectedProvision(state) {
        
    }
}

export default getters;