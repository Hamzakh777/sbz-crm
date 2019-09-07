import "../bootstrap";
import Vuelidate from 'vuelidate';
import store from "../store";
import SalesOrdersFilter from "../components/SalesOrders/Browse/SalesOrdersFilter.vue";
import SalesOrdersPaginator from '../components/SalesOrders/Browse/SalesOrdersPaginator.vue';
import ProgressBar from '../components/SalesOrders/EditAdd/progressBar';
import BaseLoader from '../components/baseComponents/BaseLoader.vue';
import DuplicateButton from '../components/SalesOrders/EditAdd/duplicateButton';
import App from '../components/SalesOrders/EditAdd/App.vue';
import Toasted from 'vue-toasted';

Vue.config.productionTip = false;

Vue.use(Vuelidate);

Vue.use(Toasted, {
    duration: 4000,
    keepOnHover: true,
    className: 'toast-card'
});

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
        DuplicateButton,
        ProgressBar,
        BaseLoader,
        App
    },
    store,
}).$mount("#app");
