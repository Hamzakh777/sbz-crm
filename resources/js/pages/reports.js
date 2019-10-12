import '../bootstrap';
import TheReports from '../components/reports/TheReports.vue';

Vue.config.productionTip = false;

Vue.filter('capitalize', function (value) {
    if (!value) return '';
    value = value.toString();
    // to capitalize the first char only
    return value.charAt(0).toUpperCase() + value.slice(1);
  })

const app = new Vue({
    el: '#app',

    components: {
        TheReports
    }
});
