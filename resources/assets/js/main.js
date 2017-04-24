//import Vue from `vue`;
//import Hero from `./components/Hero.vue`;
require('./bootstrap');

window.Vue = require('vue');

Vue.component('Profile', require('./components/Profile.vue'));

new Vue({
    el: 'body',
    components: { profile }
});
