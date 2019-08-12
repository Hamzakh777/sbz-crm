import '../bootstrap';
import Store from '../store';

new Vue({
    store,
    render: h => h(App),
}).$mount('#app');