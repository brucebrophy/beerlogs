@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<div class="md:col-5">
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
			<div class="col-6 mt-6 md:mt-0">
				@foreach ($user->beers as $beer)
					<div href="{{ route('beers.show', $beer->id) }}" class="rounded-lg mb-2 overflow-hidden border border-gray-200 shadow-md hover:shadow-lg hover:border-indigo-600 transition ease-in duration-100 bg-white">				
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
							@can('update', $beer)
								<div class="flex mt-6">
									<a class="font-mono uppercase text-indigo-600 hover:text-indigo-900" href="{{ route('beers.edit', $beer->slug) }}">Edit</a>
								</div>
							@endcan
						</div>				
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
