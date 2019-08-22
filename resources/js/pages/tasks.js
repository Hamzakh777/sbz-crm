import "../bootstrap";
import store from "../store";
import TasksPanel from '../components/tasks/TasksPanel.vue';

new Vue({
    components: {
        TasksPanel
    },
    store,
}).$mount("#app");
