import "../bootstrap";
import SearchBar from '../components/search/searchBar.vue';

Vue.config.productionTip = false;

new Vue({
    components: {
        SearchBar
    }
}).$mount("#search-bar");
