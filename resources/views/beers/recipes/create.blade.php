@extends('layouts.app')

@section('content')
	{!! Form::open(['route' => ['beers.recipes.store', $beer->slug]]) !!}
		<div class="container mx-auto">
			<div class="row">
				<div class="col-12">
					<h1>Create Recipe</h1>
				</div>
			</div>
			<div class="row">
				<div class="lg:col-4">
					<hop-selector-component />
				</div>
			</div>
			<div class="row">
				<button type="submit">Submit</button>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
