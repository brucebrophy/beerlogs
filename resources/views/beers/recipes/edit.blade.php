@extends('layouts.app')

@section('content')
	{!! Form::model($recipe, ['route' => ['beers.recipes.update', $beer->slug, $recipe->uuid], 'method' => 'PATCH']) !!}
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

	<div class="row">
		<div class="col-12 md:col-8 md:offset-2">
			<div class="rounded-lg shadow-lg border border-red-600 bg-white mt-6">
				<div class="p-8">
					{!! Form::open(['route' => ['beers.recipes.destroy', $beer->slug, $recipe->uuid], 'method' => 'DELETE']) !!}
						{{ Form::label('name', 'Delete Recipe', ['class' => 'font-mono font-semibold text-red-600 block']) }}
						<div class="flex align-items-center mt-2">
							{{ Form::text('confirmation', null, ['class' => 'form-input font-mono w-full border', 'placeholder' => 'Type DELETE to confirm']) }}
							<button type="submit" class="px-8 py-3 border-2 border-red-600 text-red-600 font-mono hover:bg-red-600 hover:text-white font-bold tracking-wide bg-white ml-2">Delete</button>
						</div>
						@error('confirmation')
							<span class="block mt-2 font-mono text-sm text-red-600">{{ $message }}</span>
						@enderror
						@if(session('error'))
							<span class="block mt-2 font-mono text-sm text-red-600">{{ session('error') }}</span>
						@endif
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
