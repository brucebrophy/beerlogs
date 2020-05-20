@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<div class="col-12">
				<div class="col-12 md:col-8 md:offset-2">
					<div class="rounded-lg shadow-lg bg-white">
						{!! Form::model($user, ['route' => ['users.update', $user->username], 'method' => 'PATCH']) !!}
							<div class="p-8">
								<div class="mb-5">
									{{ Form::label('name', 'Name', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
									{{ Form::text('name', $user->name, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Jelly King']) }}
									@error('name')
										<span class="block mt-2 font-mono text-sm text-red-600">{{ $message }}</span>
									@enderror
								</div>
								<div class="mb-5">
									{{ Form::label('email', 'Email', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
									{{ Form::text('email', $user->email, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Jelly King']) }}
									@error('email')
										<span class="block mt-2 font-mono text-sm text-red-600">{{ $message }}</span>
									@enderror
								</div>
								<div class="flex justify-end">
									<button type="submit" class="px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Update Profile</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 md:col-8 md:offset-2">
				<div class="rounded-lg shadow-lg border border-red-600 bg-white mt-6">
					<div class="p-8">
						{!! Form::open(['route' => ['users.destroy', $user->username], 'method' => 'DELETE']) !!}
							{{ Form::label('name', 'Delete Record', ['class' => 'font-mono font-semibold text-red-600 block']) }}
							<div class="flex align-items-center mt-2">
								{{ Form::text('confirm_email', null, ['class' => 'form-input font-mono w-full border', 'placeholder' => 'Type ' . $user->email . ' to confirm delete']) }}
								<button type="submit" class="px-8 py-3 border-2 border-red-600 text-red-600 font-mono hover:bg-red-600 hover:text-white font-bold tracking-wide bg-white ml-2">Delete</button>
							</div>
							@error('confirm_email')
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
	</div>
@endsection
