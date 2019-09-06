import "../bootstrap";
import SearchBar from '../components/search/searchBar.vue';
import VueInstantSearch from 'vue-instantsearch';

Vue.config.productionTip = false;

Vue.use(VueInstantSearch);

new Vue({
    components: {
        SearchBar
    }
}).$mount("#search-bar");
