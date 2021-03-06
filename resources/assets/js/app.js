
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('hello-form', require('./components/HelloForm.vue'));
Vue.component('image-upload', require('./components/ImageUpload.vue'));
Vue.component('opendata-header-retrieve', require('./components/OpendataHeaderRetrieve.vue'));
Vue.component('opendata-fetch', require('./components/OpendataFetch.vue'));
Vue.component('opendata-form', require('./components/OpendataForm.vue'));

const app = new Vue({
    el: '#app'
});
