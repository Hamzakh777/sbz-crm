import Vuex from 'vuex';
import Vue from 'vue';
import salesOrders from './modules/salesOrders';
import tasks from './modules/tasks';
import compensations from './modules/compensations';

// load Vuex
Vue.use(Vuex);

// create store
export default new Vuex.Store({
    modules: {
        salesOrders,
        tasks,
        compensations
    },
});
