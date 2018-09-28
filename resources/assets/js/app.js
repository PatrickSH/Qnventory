
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
require('axios');
window.Vue = require('vue');
require('./misc/clickevents');
import { library } from '@fortawesome/fontawesome-svg-core';
import { faTrash,faEdit,faPaperclip } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(faTrash,faEdit,faPaperclip);

Vue.component('font-awesome-icon', FontAwesomeIcon);

axios.defaults.headers.common['Token-one'] = document.head.querySelector("[property~=token_one][content]").content;
axios.defaults.headers.common['Token-two'] = document.head.querySelector("[property~=token_two][content]").content;
axios.defaults.headers.common['Token-three'] = document.head.querySelector("[property~=token_three][content]").content;
axios.defaults.headers.common['Active-org'] = document.head.querySelector("[property~=active_org][content]").content;

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
Vue.component('qr-codes', require('./components/qr-codes/QRCodesComponent.vue'));
Vue.component('organizations', require('./components/OrganizationSwitcherComponent.vue'));
Vue.component('create-freezer-item', require('./components/scan/CreateFreezerItemComponent.vue'));
Vue.component('use-qr-code-scan', require('./components/scan/UseQRCodeComponent.vue'));
Vue.component('list-org-cats', require('./components/ListOrganizationCategories.vue'));
Vue.component('list-org-freezers', require('./components/ListOrganizationFreezers.vue'));
Vue.component('list-org-items', require('./components/ListOrganizationItems.vue'));


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
