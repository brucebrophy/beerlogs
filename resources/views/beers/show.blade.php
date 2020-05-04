@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<h1>{{ $beer->name }}</h1>
			<p>{{ $beer->description }}</p>
		</div>
	</div>
@endsection
