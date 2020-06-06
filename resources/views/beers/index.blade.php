@extends('layouts.app')

@section('content')
	<div class="container mx-auto pb-8">
		<div class="md:grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:col-gap-6 md:row-gap-6">
			@foreach ($beers as $beer)
				<div class="flex">
					<a href="{{ route('beers.show', $beer->slug) }}" class="flex w-full rounded-lg my-2 md:my-0 overflow-hidden border border-gray-200 shadow-md hover:shadow-lg hover:border-indigo-600 transition ease-in duration-100 bg-white">				
						<div class="flex flex-col justify-between p-6 w-full">
							<div>
								<span class="uppercase text-indigo-400 font-mono font-bold text-xs">{{ $beer->style->name }}</span>
								<div class="font-bold font-mono text-xl mt-2 mb-2 text-indigo-600 capitalize">{{ $beer->name }}</div>
								<p class="text-gray-700 font-mono tracking-tight text-sm leading-tight lowercase">{{ Str::limit($beer->notes, 50) }}</p>
								<p class="text-gray-700 text-base mt-2 leading-tight">{{ \Str::limit($beer->description, 90) }}</p>
							</div>
							<div>
								@if($recipe = $beer->recipes->first())
									<div class="mt-4 flex justify-between">
										<span class="font-bold text-gray-600">OG: {{ $recipe->og }}</span>
										<span class="font-bold text-gray-600">FG: {{ $recipe->fg }}</span>
									</div>
									<div class="mt-4 flex justify-between">
										<span class="font-bold text-gray-600">ABV: {{ $recipe->abv }}%</span>
										<span class="font-bold text-gray-600">IBU: {{ $recipe->ibu }}</span>
									</div>
								@endif
							</div>
						</div>				
					</a>
				</div>		
			@endforeach
		</div>

		<div class="row">
			<div class="col-12">
				<div class="mt-8">
					{{ $beers->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection
