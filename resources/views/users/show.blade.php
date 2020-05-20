@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		@can('update', $user)
			<div class="row">
				<div class="col-12">
					<div class="flex justify-end mb-6">
						<a href="{{ route('users.edit', $user) }}" class="px-8 py-3 mr-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Edit Profile</a>		
					</div>
				</div>
			</div>
		@endcan
		<div class="row">
			<div class="md:col-6">
				<div class="bg-indigo-600 rounded-lg shadow-lg">
					<div class="p-8">
						<div class="mx-auto inline-block">
							<h1 class="font-mono font-semibold text-white text-xl">
								{{ $user->username }}	
							</h1>
							<p class="block mt-2 font-mono text-white opacity-75">Member Since {{ $user->created_at->diffForHumans() }}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 md:col-6 mt-6 md:mt-0">
				@foreach ($user->beers as $beer)
					<a href="{{ route('beers.show', $beer->slug) }}" class="block rounded-lg mb-2 overflow-hidden border border-gray-200 shadow-md hover:shadow-lg hover:border-indigo-600 transition ease-in duration-100 bg-white">				
						<div class="px-6 py-6"> 
							<span class="uppercase text-indigo-400 font-mono font-bold text-xs">{{ $beer->style->name }}</span>
							<div class="font-bold font-mono text-xl mt-2 mb-2 text-indigo-600 capitalize">{{ $beer->name }}</div>
							<p class="text-gray-700 font-mono tracking-tight text-sm leading-tight lowercase">{{ Str::limit($beer->notes, 50) }}</p>
							<p class="text-gray-700 text-base mt-2 leading-tight">{{ \Str::limit($beer->description, 90) }}</p>
							<div class="mt-4 flex justify-between">
								<span class="font-bold text-gray-600">OG: 1.06</span>
								<span class="font-bold text-gray-600">FG: 1.002</span>
							</div>
							<div class="mt-4 flex justify-between">
								<span class="font-bold text-gray-600">ABV: 6.0</span>
								<span class="font-bold text-gray-600">IBU: 35</span>
							</div>
						</div>				
					</a>
				@endforeach
			</div>
		</div>
	</div>
@endsection
