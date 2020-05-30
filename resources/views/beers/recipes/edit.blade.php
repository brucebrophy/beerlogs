@extends('layouts.app')

@section('content')
	{!! Form::model($recipe, ['route' => ['beers.recipes.update', $beer->slug, $recipe->id], 'method' => 'PATCH']) !!}
		<div class="container mx-auto">
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			@include('beers.recipes.partials.form')

			<div class="row">
				<div class="col-12">
					<button type="submit" class="mt-8 px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Update Recipe</button>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
