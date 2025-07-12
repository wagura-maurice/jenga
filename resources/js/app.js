
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import 'bootstrap';

// Import Vue
import Vue from 'vue';

// Import Vue components
import Example from './components/Example.vue';

// Configure Vue in production
Vue.config.productionTip = false;

// Create a new Vue instance
const app = new Vue({
    el: '#app',
    components: { Example },
    render: h => h(Example)
});

// Export the app for potential HMR
if (module.hot) {
    module.hot.accept();
}
