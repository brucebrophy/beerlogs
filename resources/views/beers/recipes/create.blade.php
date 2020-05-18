@extends('layouts.app')

@section('content')
	{!! Form::open(['route' => ['beers.recipes.store', $beer->slug]]) !!}
		<div class="container mx-auto">
			<div class="row">
				<div class="col-12">
					<h1>Create Recipe</h1>
				</div>
			</div>

			@include('beers.recipes.partials.form')

			<div class="row">
				<div class="col-12">
					<button type="submit" class="mt-8 px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Save Recipe</button>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
