require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue').default);

Vue.component('navigation-component', require('./components/Navigation.vue').default);
Vue.component('malt-selector-component', require('./components/MaltSelector.vue').default);
Vue.component('hop-selector-component', require('./components/HopSelector.vue').default);
Vue.component('yeast-selector-component', require('./components/YeastSelector.vue').default);

Vue.component('comment-feed-component', require('./components/CommentFeed.vue').default);
Vue.component('comment-form-component', require('./components/CommentForm.vue').default);
Vue.component('comment-card-component', require('./components/CommentCard.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	el: '#app',
});