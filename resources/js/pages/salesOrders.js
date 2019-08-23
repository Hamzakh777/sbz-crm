import "../bootstrap";
import Vuelidate from 'vuelidate';
import store from "../store";
import SalesOrdersFilter from "../components/SalesOrders/Browse/SalesOrdersFilter.vue";
import SalesOrdersPaginator from '../components/SalesOrders/Browse/SalesOrdersPaginator.vue';
import App from '../components/SalesOrders/EditAdd/App.vue';
import SalesOrdersSaveButton from '../components/SalesOrders/EditAdd/salesOrdersSaveButton';

Vue.use(Vuelidate);

new Vue({
    components: {
        SalesOrdersPaginator,
        SalesOrdersFilter,
        SalesOrdersSaveButton,
        App
    },
    store,
}).$mount("#app");
