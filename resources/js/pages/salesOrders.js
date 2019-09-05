import "../bootstrap";
import Vuelidate from 'vuelidate';
import store from "../store";
import SalesOrdersFilter from "../components/SalesOrders/Browse/SalesOrdersFilter.vue";
import SalesOrdersPaginator from '../components/SalesOrders/Browse/SalesOrdersPaginator.vue';
import ProgressBar from '../components/SalesOrders/EditAdd/progressBar';
import App from '../components/SalesOrders/EditAdd/App.vue';

Vue.config.productionTip = false;

Vue.use(Vuelidate);
Vue.filter("changeDateFormat", function(value) {
    if (value != null) {
        const date = new Date(value);
        const month = parseInt(date.getMonth()) + 1; // or some absurd reason it start counting months from 0
        const day = date.getDate();
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    } else {
        return null;
    }
});

new Vue({
    components: {
        SalesOrdersPaginator,
        SalesOrdersFilter,
        ProgressBar,
        App
    },
    store,
}).$mount("#app");
