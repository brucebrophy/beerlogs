<navigation-component>
	<template v-slot:logo>
		<a href="{{ url('/') }}" class="flex items-center text-lg font-semibold text-gray-100 no-underline h-full">
			<h1 class="text-white font-mono text-lg font-semibold tracking-widest uppercase">{{ config('app.name') }}</h1>
		</a>
	</template>
	<template v-slot:main>
		<a href="{{ route('beers.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-mono tracking-wider font-medium leading-5 text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:text-white focus:bg-indigo-900 transition duration-150 ease-in-out">Beers</a>
	</template>
	<template v-slot:mobile>
		<a href="#" class="block px-3 py-2 rounded-md text-base font-mono tracking-wider font-medium text-white bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out">Dashboard</a>
		<a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-mono tracking-wider font-medium text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out">Team</a>
		@guest
			<a class="mt-1 block px-3 py-2 rounded-md text-base font-mono tracking-wider font-medium text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out" href="{{ route('login') }}">{{ __('Login') }}</a>
			<a class="mt-1 block px-3 py-2 rounded-md text-base font-mono tracking-wider font-medium text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:bg-indigo-900 transition duration-150 ease-in-out" href="{{ route('register') }}">{{ __('Register') }}</a>
		@endguest
	</template>
	<template v-slot:profile>
		@guest
			<a class="ml-4 px-3 py-2 rounded-md text-sm font-mono tracking-wider font-medium leading-5 text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:text-white focus:bg-indigo-900 transition duration-150 ease-in-out" href="{{ route('login') }}">{{ __('Login') }}</a>
			<a class="ml-4 px-3 py-2 rounded-md text-sm font-mono tracking-wider font-medium leading-5 text-white hover:text-white hover:bg-indigo-900 focus:outline-none focus:text-white focus:bg-indigo-900 transition duration-150 ease-in-out" href="{{ route('register') }}">{{ __('Register') }}</a>
		@else
				<a href="#" class="block px-4 py-2 font-mono text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
				{{ csrf_field() }}
			</form>
		@endif
	</template>
</navigation-component>