@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<h1>Create Beer</h1>
			<div class="col-12 md:col-8 md:offset-2">
				<div class="rounded-lg shadow-lg bg-white">
					{!! Form::model($beer, ['route' => ['beers.update', $beer->id], 'method' => 'PUT']) !!}
					<div class="p-8">
						@include('beers.partials.form')
						<div class="flex justify-end">
							<button type="submit" class="px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Update Beer</button>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
