
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
require('axios');
window.Vue = require('vue');
require('./misc/clickevents');
axios.defaults.headers.common['Token-one'] = document.head.querySelector("[property~=token_one][content]").content;
axios.defaults.headers.common['Token-two'] = document.head.querySelector("[property~=token_two][content]").content;
axios.defaults.headers.common['Token-three'] = document.head.querySelector("[property~=token_three][content]").content;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('login-component', require('./components/LoginComponent.vue'));
Vue.component('user-data', require('./components/UserDataComponent.vue'));
Vue.component('modal', require('./components/ModalComponent.vue'));
Vue.component('first-login-data', require('./components/FirstLoginDataComponent.vue'));
Vue.component('dashboard', require('./components/DashboardComponent.vue'));
Vue.component('user-image', require('./components/UserImageComponent.vue'));


const app = new Vue({
    el: '#app',
    data: {
        message: "Hej!"
    },
    methods: {
        hideModal : function(e){
        }
    },
});
