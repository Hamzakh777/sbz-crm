const mutations = {
    setSalesOrders(state, data) {
        state.salesOrders = data;
    },
    setContractPerson(state, data) {
        state.salesOrder.contractPeople.push(data);
    }
};

export default mutations;