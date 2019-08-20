import "../bootstrap";
import store from "../store";
import TasksCollection from '../components/tasks/TasksCollection.vue';

new Vue({
    components: {
        TasksCollection
    },
    store,
}).$mount("#app");
