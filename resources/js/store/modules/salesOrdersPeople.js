
const state = {
    people: [],
    isLoading: false,
};

const getters = {
    allPeople(state, getters, rootState) {
        return state.people;
    } ,
    isLoading(state) {
        return state.isLoading;
    }
};

const actions = {
    async fetchPeople({commit, rootGetters}) {
        state.isLoading = true;
        const salesOrderId = rootGetters.salesOrder.id;
        try {
            const response = await axios.get(`/api/sales-orders/${salesOrderId}/sales-order-people/`)

            state.isLoading = false;
            commit('setPeople', response.data.people);
        } catch(e) {
            state.isLoading = false;
            alert(e)
        }
    },
    /**
    * Add contract person to the
    * sales order
    * @param {*} param0
    * @param {object} person
    */
    async addPerson({ commit }, person) {
        state.isLoading = true;
        try {
            const response = await axios.post('/api/sales-order-people', person);
    
            state.isLoading = false;
            // if (response.data.person.id) {
            //     person.id = response.data.person.id;
            // }
            commit("addPerson", response.data.person);
        } catch (error) {
            alert(error);
        }
    },

    /**
     * 
     * @param {Object} param0 
     * @param {int} id 
     */
    async deletePerson({commit}, id) {
        state.isLoading = true;
        await axios.delete(`/api/sales-order-people/${id}`);

        state.isLoading = false;

        commit('deletePerson', id);
    },
};

const mutations = {
    setPeople(state, people) {
        state.people = people;
    },
    addPerson(state, person) {
        state.people.push(person);
    },
    deletePerson(state, id) {
        state.people = state.people.filter(person => person.id !== id);
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
