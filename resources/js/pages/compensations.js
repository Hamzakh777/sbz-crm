import "../bootstrap";
import store from "../store";
import Vuelidate from 'vuelidate';
import CompensationsPanel from '../components/compensation/compensationPanel.vue';
import CompensationOverviewPanel from '../components/compensation/compensationOverviewPanel.vue';

Vue.config.productionTip = false;

Vue.use(Vuelidate);

new Vue({
    components: {
        CompensationsPanel,
        CompensationOverviewPanel
    },
    store,
}).$mount("#app");
