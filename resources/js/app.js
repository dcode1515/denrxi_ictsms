/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Login', require('./components/Auth/Login.vue').default);
Vue.component('Ticket', require('./components/Helpdesk/Ticket.vue').default);
Vue.component('Headoffice', require('./components/Admin/Headoffice.vue').default);
Vue.component('Office', require('./components/Admin/Office.vue').default);
Vue.component('Tickettype', require('./components/Admin/Tickettype.vue').default);
Vue.component('Register', require('./components/Auth/Register.vue').default);
Vue.component('Usermanagement', require('./components/Admin/Usermanagement.vue').default);
Vue.component('Profile', require('./components/Auth/Profile.vue').default);
Vue.component('Ticketcategory', require('./components/Admin/Ticketcategory.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
