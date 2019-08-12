import Vuex from 'vuex';
import Vue from 'vue';
import salesOrders from './modules/salesOrders';

// load Vuex
Vue.use(Vuex);

// create store
export default new Vuex.Store({
    modules: {
        salesOrders,
    },
});
