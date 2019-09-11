const getters = {
    isLoading(state) {
        return state.isLoading;
    },

    compensation(state) {
        return state.compensation;
    },

    salesOrderPeople(state, getters, rootState) {
        // since the same component will be used on two independ 
        // views, one of which the salesorder people is already
        // defined, we want to get it
        if(rootState.salesOrders.salesOrder.id === null) {
            return state.compensation.salesOrder.people;
        } else {
            return rootState.salesOrders.salesOrder.people;
        }
    },

    totalExpectedProvision(state) {
        
    }
}

export default getters;