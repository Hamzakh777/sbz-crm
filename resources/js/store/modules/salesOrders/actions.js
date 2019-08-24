const actions = { 
    /**
     * Get all the sales orders
     * @param {*} param0
     */
    async fetchSalesOrders({ commit }) {
        state.showContractLoader = true;
        try {
            const response = await axios.post("sales-orders-api");

            state.showContractLoader = false;
            commit("setSalesOrders", response.data.salesOrders);
        } catch (error) {
            console.error(error);
        }
    },

    async storeSalesOrder({ commit }) {
        try {
            state.showContractLoader = true;
            await setTimeout(() => {
                const response = axios.post('/api/sales-orders', state.salesOrder);
                state.showContractLoader = false;
            }, 4000);
        } catch (error) {
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

export default actions;