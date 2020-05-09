@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<div class="col-12 md:col-8 md:offset-2">
				<div class="rounded-lg shadow-lg bg-white">
					{!! Form::model($beer, ['route' => ['beers.update', $beer->slug], 'method' => 'PATCH']) !!}
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
		<div class="row">
			<div class="col-12 md:col-8 md:offset-2">
				<div class="rounded-lg shadow-lg border border-red-600 bg-white mt-6">
					<div class="p-8">
						{!! Form::open(['route' => ['beers.destroy', $beer->id], 'method' => 'DELETE']) !!}
							{{ Form::label('name', 'Delete Record', ['class' => 'font-mono font-semibold text-red-600 block']) }}
							<div class="flex align-items-center mt-2">
								{{ Form::text('name', null, ['class' => 'form-input font-mono w-full border', 'placeholder' => 'Type ' . $beer->name . ' to confirm delete']) }}
								<button type="submit" class="px-8 py-3 border-2 border-red-600 text-red-600 font-mono hover:bg-red-600 hover:text-white font-bold tracking-wide bg-white ml-2">Delete</button>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
