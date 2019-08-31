import actions from './actions';
import getters from './getters';
import state from './state';
import mutations from './mutations';

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}