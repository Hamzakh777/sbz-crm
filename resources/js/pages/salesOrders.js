import "../bootstrap";
import store from "../store";
import SalesOrdersFilter from "../components/SalesOrders/SalesOrdersFilter.vue";
import SalesOrdersPaginator from '../components/SalesOrders/SalesOrdersPaginator.vue';

new Vue({
    components: {
        SalesOrdersPaginator,
        SalesOrdersFilter
    },
    store,
}).$mount("#app");
