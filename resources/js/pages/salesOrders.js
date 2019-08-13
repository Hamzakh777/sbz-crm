import "../bootstrap";
import store from "../store";
import SalesOrdersFilter from "../components/SalesOrders/SalesOrdersFilter.vue";
import SalesOrdersApp  from '../pages/SalesOrders.vue';

new Vue({
    components: {
        SalesOrdersApp,
        SalesOrdersFilter
    },
    store,
}).$mount("#app");
