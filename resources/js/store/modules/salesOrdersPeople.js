
const state = {
    people: [],
    isLoading: false,
};

const getters = {
    allPeople(state) {
        return state.people;
    } ,
    isLoading(state) {
        return state.isLoading;
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
        state.isLoading = true;
        const response = await axios.post('/api/sales-order-people', person);

        state.isLoading = false;
        if (response.data.person.id) {
            person.id = response.data.person.id;
        }

        commit("addPerson", person);
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
    addPerson(state, person) {
        state.people.unshift(person);
    },
    deletePerson(state, id) {
        state.people = state.people.filter(person => person.id !== id);
    },
    
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
