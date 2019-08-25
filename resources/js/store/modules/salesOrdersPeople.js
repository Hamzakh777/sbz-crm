
const state = {
    people: []
};

const getters = {
    allPeople(state) {
        return state.people;
    } 
};

const actions = {
    /**
    * Add contract person to the
    * sales order
    * @param {*} param0
    * @param {object} person
    */
    async addPerson({ commit }, person) {
        const response = await axios.post('/api/sales-order-people', person);

        person.id = response.person.id;

        commit("addPerson", person);
    },

    /**
     * 
     * @param {Object} param0 
     * @param {int} id 
     */
    async deletePerson({commit}, id) {
        const response = await axios.delete(`/api/sales-order-people/${id}`);

        commit('deletePerson', id);
    },

};

const mutations = {
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
