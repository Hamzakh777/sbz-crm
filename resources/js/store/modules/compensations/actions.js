const actions = {
    async fetchCompensation({commit, state, rootState}) {
        state.isLoading = true;
        try {
            // compensation page
            if (state.compensation.id !== null && state.compensation.id !== undefined) {
                const response = await axios.get(`/api/compensations/${state.compensation.id}`);
    
                commit('setCompensation', response.data.compensation);
                state.isLoading = false;
            } else {
                const salesOrderId = rootState.salesOrders.salesOrder.id;
                const response = await axios.get(`/api/sales-orders/${salesOrderId}/compensation`);

                commit('setCompensation', response.data.compensation);
                state.isLoading = false;
            }
        } catch (error) {
            state.isLoading = false;
            alert(error);
        }
    },

    async store({ commit, state, rootState}) {
        state.isLoading = true;
        try {
            const data = state.compensation;
            // the component is used on two different pages, 
            // one where we have direct access to the sales order id
            // one where it depends on the dropdown selected value
            if (rootState.salesOrders.salesOrder.id !== null && rootState.salesOrders.salesOrder.id !== undefined) {
                data.salesOrder.id = rootState.salesOrders.salesOrder.id;
            } else {
                data.salesOrder.id = state.compensation.salesOrder.id;
            }
            const response = await axios.post(`/api/compensations/`, data);
            
            state.isLoading = false;
            commit('setCompensationId', response.data.compensation.id);
        } catch (error) {
            state.isLoading = false;
            alert(error);
        }
    },

    async update({commit, state}) {
        state.isLoading = true;
        try {
            await axios.put(`/api/compensations/${state.compensation.id}`, state.compensation);

            state.isLoading = false;
        } catch (error) {
            state.isLoading;
            alert(error);
        }
    }
};

export default actions;