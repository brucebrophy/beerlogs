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

Vue.component('drop-down-component', require('./components/DropDown.vue').default);
Vue.component('profile-drop-down-component', require('./components/ProfileDropDown.vue').default);
Vue.component('onclick-outside-component', require('./components/OnClickOutside.vue').default);

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

const menuToggle = () => {
	const menuToggleBtn = document.querySelector('#nav-hamburger');
	const mobileNav = document.querySelector('#mobile-nav');
	const openBtn = document.querySelector('#open-nav');
	const closeBtn = document.querySelector('#close-nav');

	menuToggleBtn.addEventListener('click', () => {
		openBtn.classList.toggle('hidden');
		closeBtn.classList.toggle('hidden');
		mobileNav.classList.toggle('hidden');
	})
};
menuToggle();
