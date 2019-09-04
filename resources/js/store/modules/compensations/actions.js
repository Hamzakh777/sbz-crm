const actions = {
    async fetchCompensation({commit, state}) {
        state.isLoading = true;
        try {
            const response = await axios.get(`/api/compensations/${state.compensation.id}`);

            commit('setCompensation', response.data.compensation);
            state.isLoading = false;
        } catch (error) {
            state.isLoading = false;
            alert(error);
        }
    },

    async store({commit, state}) {
        state.isLoading = true;
        try {
            const response = await axios.post(`/api/compensations/`, state.compensation);
            
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