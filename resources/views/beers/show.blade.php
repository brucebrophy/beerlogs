@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="md:col-5">
                <div class="rounded-lg shadow-lg bg-white">
                    <div class="p-8">
                        <span class="uppercase font-mono text-indigo-400 font-bold text-sm">{{ $beer->style->name }}</span>
                        <h1 class="font-mono text-2xl font-bold leading-tight capitalize my-4 text-indigo-600">{{ $beer->name }}</h1>
                        <p class="font-mono leading-normal">{{ $beer->notes }}</p>
                        <p class="mt-4 leading-normal">{!! nl2br($beer->description) !!}</p>
                    </div>
                </div>
                @can('update', $beer)
                    <div class="row">
                        <div class="col-12">
                            <div class="flex flex-col mb-6">
                                <a href="{{ route('beers.edit', $beer->slug) }}" class="mt-3 py-3 text-center border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Edit Beer</a>
                                @if(count($beer->recipes))
                                    <a href="{{ route('beers.recipes.edit', [$beer->slug, $recipe->uuid]) }}" class="mt-3 py-3 text-center border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Edit Recipe</a>
                                @else
                                    <a href="{{ route('beers.recipes.create', $beer->slug) }}" class="mt-3 py-3 text-center border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Add Recipe</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="md:col-7">
                <div class="border-b border-indigo-600">
                    <div class="flex overflow-x-scroll">
                        <div class="p-3 {{ !request()->has('tab') ? 'border-b-2 border-indigo-900' : '' }}">
                            <a href="{{ route('beers.show', $beer->slug) }}" class="p-3 mx-2 inline-block font-mono">Recipe</a>
                        </div>
                        <div class="p-3 {{ request()->get('tab') === 'comments' ? 'border-b-2 border-indigo-900' : '' }}">
                            <a href="{{ route('beers.show', [$beer->slug, 'tab' => 'comments']) }}" class="p-3 mx-2 inline-block font-mono">Comments</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mt-6">
                            @if(! request()->has('tab'))
                                @if($recipe)
                                    <div class="rounded-lg shadow-lg bg-white">
                                        <div class="p-8">
                                            <div class="rounded bg-indigo-600">
                                                <div class="flex justify-around pt-4 pb-2 px-4">
                                                    <div class="w-full text-center">
                                                        <span class="block text-white font-mono text-xl">IBU</span>
                                                        <span class="block mt-2 text-white font-mono font-semibold text-3xl">{{ $recipe->ibu }}</span>
                                                    </div>
                                                    <div class="w-full text-center">
                                                        <span class="block text-white font-mono text-xl">ABV</span>
                                                        <span class="block mt-2 text-white font-mono font-semibold text-3xl">{{ $recipe->abv }}%</span>
                                                    </div>
                                                </div>
                                                <div class="flex justify-around pt-2 pb-4 px-4">
                                                    <div class="w-full text-center">
                                                        <span class="block text-white font-mono text-xl">OG</span>
                                                        <span class="block mt-2 text-white font-mono font-semibold text-3xl">{{ $recipe->og }}</span>
                                                    </div>
                                                    <div class="w-full text-center">
                                                        <span class="block text-white font-mono text-xl">FG</span>
                                                        <span class="block mt-2 text-white font-mono font-semibold text-3xl">{{ $recipe->fg }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-5">
                                                <h2 class="mb-3 uppercase font-mono text-lg text-center">Mash</h2>
                                                @foreach ($recipe->malt_additions as $malt_addition)
                                                    <div class="mb-3">
                                                        <h3 class="font-mono font-semibold mb-2">{{ $malt_addition->amount }}{{ $malt_addition->unit->symbol }} - {{ $malt_addition->malt->name }}</h3>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="mt-5">
                                                <h2 class="mb-3 uppercase font-mono text-lg text-center">Hops</h2>
                                                @foreach ($recipe->hop_additions as $hop_addition)
                                                    <div class="mb-3">
                                                        <h3 class="font-mono font-semibold mb-2">{{ $hop_addition->amount }}{{ $hop_addition->unit->symbol }} - {{ $hop_addition->hop->name }}</h3>
                                                        <p>
                                                            {{ $hop_addition->method->name }} - {{ $hop_addition->minute }} min
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="mt-5">
                                                <h2 class="mb-3 uppercase font-mono text-lg text-center">Yeast</h2>
                                                @foreach ($recipe->yeast_additions as $yeast_addition)
                                                    <div class="mb-3">
                                                        <h3 class="font-mono font-semibold mb-2">{{ $yeast_addition->yeast->name }} ({{ $yeast_addition->yeast->strain }})</h3>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="mt-5">
                                                <h2 class="mb-3 uppercase font-mono text-lg text-center">Instructions</h2>
                                                <div class="leading-snug">
                                                    {!! nl2br($recipe->instructions) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if(request()->get('tab') === 'comments')
                                <comment-feed-component endpoint="/api/beers/{{ $beer->slug}}/comments" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
