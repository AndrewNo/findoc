require('./bootstrap');

window.Vue = require('vue');

Vue.component('modal-account', require('./components/AccountModal.vue'));

new Vue ({
    el: '#add_account_modal',
    data: {
        showModal: false
    }
});