import "../bootstrap";
import store from "../store";
import SalesOrdersFilter from "../components/SalesOrders/SalesOrdersFilter.vue";
import SalesOrdersPaginator from '../components/SalesOrders/SalesOrdersPaginator.vue';
import SalesOrdersApp  from '../pages/SalesOrders.vue';

new Vue({
    components: {
        SalesOrdersApp,
        SalesOrdersPaginator,
        SalesOrdersFilter
    },
    store,
}).$mount("#app");
