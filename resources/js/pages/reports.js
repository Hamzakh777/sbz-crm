import '../bootstrap';
import TheReports from '../components/reports/TheReports.vue';

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',

    components: {
        TheReports
    }
});
