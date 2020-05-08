@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<div class="md:col-7">
				<div class="rounded-lg shadow-lg bg-white">
					<div class="p-8">
						<span class="uppercase font-mono text-indigo-400 font-bold text-sm">{{ $beer->style->name }}</span>
						<h1 class="font-mono text-2xl font-bold leading-tight capitalize my-4 text-indigo-600">{{ $beer->name }}</h1>
						<p class="font-mono leading-normal">{{ $beer->notes }}</p>
						<p class="mt-4 leading-normal">{{ $beer->description }}</p>
						<ul class="mt-4">
							<li class="mb-2 leading-normal"><span class="font-mono font-semibold">Malts:</span> 2-Row (Rahr), Golden Promise, Pale Ale, Pale Wheat, Carafoam, Chit, Acidulated</li>
							<li class="mb-2 leading-normal"><span class="font-mono font-semibold">Hops:</span> Cascade, Simcoe, Amarillo, Citra</li>
							<li class="mb-2 leading-normal"><span class="font-mono font-semibold">Yeast:</span> Vermont Ale</li>
							<li class="mb-2 leading-normal"><span class="font-mono font-semibold">Adjuncts:</span> Lactose, Dextrose, Key Lime Juice Concentrate, Vanilla Bean</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="md:col-5 mt-6 md:mt-0">
				<div class="rounded-lg shadow-lg bg-white">
					<div class="p-8">
						<h2 class="text-center mb-4 uppercase font-mono text-xl">Recipe</h2>
						<div class="rounded bg-indigo-600">
							<div class="flex justify-around pt-4 pb-2 px-4">
								<div class="w-full text-center">
									<span class="block text-white font-mono text-xl">IBU</span>
									<span class="block mt-2 text-white font-mono font-semibold text-3xl">40</span>
								</div>
								<div class="w-full text-center">
									<span class="block text-white font-mono text-xl">ABV</span>
									<span class="block mt-2 text-white font-mono font-semibold text-3xl">6%</span>
								</div>
							</div>
							<div class="flex justify-around pt-2 pb-4 px-4">
								<div class="w-full text-center">
									<span class="block text-white font-mono text-xl">OG</span>
									<span class="block mt-2 text-white font-mono font-semibold text-3xl">1.07</span>
								</div>
								<div class="w-full text-center">
									<span class="block text-white font-mono text-xl">FG</span>
									<span class="block mt-2 text-white font-mono font-semibold text-3xl">1.02</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
