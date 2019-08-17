import "../bootstrap";
import store from "../store";
import SalesOrdersFilter from "../components/SalesOrders/Browse/SalesOrdersFilter.vue";
import SalesOrdersPaginator from '../components/SalesOrders/Browse/SalesOrdersPaginator.vue';
import App from '../components/SalesOrders/EditAdd/App.vue';

new Vue({
    components: {
        SalesOrdersPaginator,
        SalesOrdersFilter,
        App
    },
    store,
}).$mount("#app");
