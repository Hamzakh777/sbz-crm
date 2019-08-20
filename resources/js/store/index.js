import Vuex from 'vuex';
import Vue from 'vue';
import salesOrders from './modules/salesOrders';
import tasks from './modules/tasks';

// load Vuex
Vue.use(Vuex);

// create store
export default new Vuex.Store({
    modules: {
        salesOrders,
        tasks
    },
});
