import "../bootstrap";
import store from "../store";
import Vuelidate from 'vuelidate';
import TasksPanel from '../components/tasks/TasksPanel.vue';

Vue.config.productionTip = false;

Vue.use(Vuelidate);

new Vue({
    components: {
        TasksPanel
    },
    store,
}).$mount("#app");
