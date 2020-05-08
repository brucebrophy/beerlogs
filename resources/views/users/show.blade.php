@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<div class="md:col-7">
				{{ $user->name }}
			</div>
			<div class="md:col-5 mt-6 md:mt-0">
				
			</div>
		</div>
	</div>
@endsection
