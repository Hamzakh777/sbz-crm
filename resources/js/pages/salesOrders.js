import "../bootstrap";
import store from "../store";
import SalesOrdersFilter from "../components/SalesOrders/Browse/SalesOrdersFilter.vue";
import SalesOrdersPaginator from '../components/SalesOrders/Browse/SalesOrdersPaginator.vue';

new Vue({
    components: {
        SalesOrdersPaginator,
        SalesOrdersFilter
    },
    store,
}).$mount("#app");
