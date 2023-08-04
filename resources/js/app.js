import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Vue = require('vue').default

Vue.component('contact-component', require('./components/Contact.vue').default);

const app = new Vue({
    el: '#app'
})
