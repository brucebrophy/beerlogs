@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<div class="col-12 md:col-8 md:offset-2">
				<div class="rounded-lg shadow-lg bg-white">
					{!! Form::open(['route' => ['beers.recipes.store', $beer->slug]]) !!}
					<div class="p-8">
						Create Recipe
						<div class="mb-5">
							{{ Form::label('notes', 'Notes', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::text('notes', $recipe->adjuncts, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Jelly King']) }}
						</div>
						<div class="flex justify-end">
							<button type="submit" class="px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Continue to Recipe -></button>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
