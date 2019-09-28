import "../bootstrap";
import store from "../store";
import Vuelidate from 'vuelidate';
import CompensationsPanel from '../components/compensation/compensationPanel.vue';
import CompensationOverviewPanel from '../components/compensation/compensationOverviewPanel.vue';

Vue.config.productionTip = false;

Vue.use(Vuelidate);

Vue.filter("changeDateFormat", function (value) {
    if (value != null) {
        const date = new Date(value);
        const month = parseInt(date.getMonth()) + 1; // for some absurd reason it start counting months from 0
        const day = date.getDate();
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    } else {
        return null;
    }
});

new Vue({
    components: {
        CompensationsPanel,
        CompensationOverviewPanel
    },
    store,
}).$mount("#app");
