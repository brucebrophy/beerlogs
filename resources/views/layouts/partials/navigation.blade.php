<nav class="bg-indigo-800 mb-6">
	<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
		<div class="relative flex items-center justify-between h-16">
			<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
				<!-- Mobile menu button-->
				<button id="nav-hamburger" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out" aria-label="Main menu" aria-expanded="false">
					<!-- Icon when menu is closed. -->
					<svg id="open-nav" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
					</svg>
					<!-- Icon when menu is open. -->
					<svg id="close-nav" class="h-6 w-6 hidden" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
					</svg>
				</button>
			</div>
			<div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
				<div class="flex-shrink-0">
					<a href="{{ url('/') }}" class="flex items-center text-lg font-semibold text-gray-100 no-underline h-full">
						<h1 class="text-white font-mono text-lg font-semibold tracking-widest uppercase">{{ config('app.name') }}</h1>
					</a>
				</div>
				<div class="hidden sm:block sm:ml-6">
					<div class="flex">
						<a href="{{ route('beers.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-mono tracking-wider font-medium leading-5 text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:text-white focus:bg-indigo-900 transition duration-150 ease-in-out">Beers</a>
					</div>
				</div>
			</div>
			<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
				<!-- Authenticated User Dropdown -->
				@guest
					<div class="ml-3 hidden sm:block">
						<a class="ml-4 px-3 py-2 rounded-md text-sm font-mono tracking-wider font-medium leading-5 text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:text-white focus:bg-indigo-900 transition duration-150 ease-in-out" href="{{ route('login') }}">{{ __('Login') }}</a>
						<a class="ml-4 px-3 py-2 rounded-md text-sm font-mono tracking-wider font-medium leading-5 text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:text-white focus:bg-indigo-900 transition duration-150 ease-in-out" href="{{ route('register') }}">{{ __('Register') }}</a>
					</div>
				@else
					<profile-drop-down-component
						label="{{ auth()->user()->username }}"
						logout-label="{{ ('Logout') }}"
						logout-route="{{ route('logout') }}"
						token="{{ csrf_token() }}">
						<template v-slot:links>
							<a href="{{ route('users.show', auth()->user()->username) }}" class="block px-4 py-2 font-mono text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Profile</a>
						</template>
					</profile-drop-down-component>
					<drop-down-component>
						<template v-slot:label>
							<svg class="w-3 sm:w-4 mt-1 fill-current" aria-hidden="true" focusable="false" data-prefix="far" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M368 224H224V80c0-8.84-7.16-16-16-16h-32c-8.84 0-16 7.16-16 16v144H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h144v144c0 8.84 7.16 16 16 16h32c8.84 0 16-7.16 16-16V288h144c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16z"></path></svg>
						</template>
						<template v-slot:links>
							<a href="{{ route('beers.create') }}" class="block px-4 py-2 font-mono text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">New Beer</a>
						</template>
					</drop-down-component>
				@endguest
			</div>
		</div>
	</div>
	<div id="mobile-nav" class="sm:hidden hidden">
		<div class="px-2 pt-2 pb-3">
			<a href="{{ route('beers.index') }}" class="mt-1 block px-3 py-2 rounded-md text-base font-mono tracking-wider font-medium text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out">Beers</a>
			@guest
				<a class="mt-1 block px-3 py-2 rounded-md text-base font-mono tracking-wider font-medium text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out" href="{{ route('login') }}">{{ __('Login') }}</a>
				<a class="mt-1 block px-3 py-2 rounded-md text-base font-mono tracking-wider font-medium text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out" href="{{ route('register') }}">{{ __('Register') }}</a>
			@endguest
		</div>
	</div>
</nav>