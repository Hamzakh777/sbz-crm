import '../bootstrap';

import BaseButton from '../components/baseComponents/BaseButton.vue';
import UserLogModal from '../components/users/UsersLogModal.vue';
import VModal from "vue-js-modal";

Vue.use(VModal);

const app = new Vue({
    el: '#app',

    components: {
        BaseButton,
        UserLogModal
    },

    methods: {
        showLogModal(id) {
            this.$modal.show('user-log-modal', id);
        }
    }
});
