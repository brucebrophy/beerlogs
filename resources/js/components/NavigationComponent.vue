<template>
	<nav class="bg-indigo-800">
		<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
			<div class="relative flex items-center justify-between h-16">
				<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
					<!-- Mobile menu button-->
					<button @click="toggleMobileMenu" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out" aria-label="Main menu" aria-expanded="false">
						<!-- Icon when menu is closed. -->
						<svg :class="mobileIsOpen ? 'hidden' : 'block'" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
						</svg>
						<!-- Icon when menu is open. -->
						<svg :class="mobileIsOpen ? 'block' : 'hidden'"  class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
						</svg>
					</button>
				</div>
				<div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
					<div class="flex-shrink-0">
						<a href="#" class="flex items-center w-full h-full">
							<slot name="logo"></slot>
						</a>
					</div>
					<div class="hidden sm:block sm:ml-6">
						<div class="flex">
							<slot name="main" />
						</div>
					</div>
				</div>
				<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
					<!-- 
						<button class="p-1 border-2 border-transparent text-white rounded-full hover:bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out" aria-label="Notifications">
							<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
							</svg>
						</button> 
					-->
					<!-- Authenticated User Dropdown -->
					<div v-if="user" class="ml-3 relative">
						<div>
							<button @click="toggleProfileMenu" class="flex font-mono tracking-wider text-base text-white focus:outline-none transition duration-150 ease-in-out" id="user-menu" aria-label="User menu" aria-haspopup="true">
								{{ user.username }}
							</button>
						</div>
						<div :class="profileIsOpen ? 'block' : 'hidden'" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
							<div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
								<slot name="profile" />
							</div>
						</div>
					</div>
					<!-- Guest -->
					<div v-else class="ml-3 hidden sm:block">
						<slot name="profile" />
					</div>
				</div>
			</div>
		</div>
		<div :class="mobileIsOpen ? 'block' : 'hidden'" class="sm:hidden">
			<div class="px-2 pt-2 pb-3">
				<slot name="mobile" />
			</div>
		</div>
	</nav>
</template>

<script>
export default {
	mounted() {
		this.user = window.user;
	},
	data() {
		return {
			user: null,
			mobileIsOpen: false,
			profileIsOpen: false
		};
	},
	methods: {
		toggleMobileMenu() {
			return (this.mobileIsOpen = !this.mobileIsOpen);
		},
		toggleProfileMenu() {
			return (this.profileIsOpen = !this.profileIsOpen);
		}
	}
};
</script>