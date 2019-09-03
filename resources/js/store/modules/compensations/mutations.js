const mutations = {
    setCompensation(state, compensation) {
        state.compensation = compensation;
    },

    setSalesOrder(state, value) {
        // since we only need the people and the sales order id
        state.compensation.salesOrder.id = value.id;
        state.compensation.salesOrder.people = value.people;
    }
}

export default mutations;