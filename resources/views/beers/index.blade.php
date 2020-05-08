@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			@foreach ($beers as $beer)
				<div class="col-6 md:col-4 lg:col-3">
					<a href="{{ route('beers.show', $beer->slug) }}" class="inline-block rounded-lg my-2 overflow-hidden border border-gray-200 shadow-md hover:shadow-lg hover:border-indigo-600 transition ease-in duration-100 bg-white">				
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
				</div>		
			@endforeach
		</div>
	</div>
@endsection
