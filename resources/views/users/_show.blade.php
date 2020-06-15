@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		@can('update', $user)
            <div class="row">
                <div class="col-12">
                    <div class="flex justify-end mb-6">
                        <a href="{{ route('users.edit', $user) }}" class="px-8 py-3 mr-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Edit Profile</a>
                    </div>
                </div>
            </div>
        @endcan
		<div class="row">
			<div class="md:col-4">
				<div class="bg-indigo-600 rounded-lg shadow-lg">
					<div class="p-8">
						<div class="mx-auto inline-block">
							<h1 class="font-mono font-semibold text-white text-xl">
								{{ $user->username }}
							</h1>
							<p class="block mt-2 font-mono text-white opacity-75">Member Since {{ $user->created_at->diffForHumans() }}</p>
						</div>
					</div>
				</div>
                <div class="mt-6">
                    <h2 class="mb-3 uppercase font-mono font-semibold text-lg text-center text-indigo-600">Activity</h2>
                    @forelse($user->comments as $comment)
                       @if($comment->commentable_type = 'App\Beers\Beer')
                            <a class="block" href="{{ route('beers.show', $comment->commentable->slug) }}">
                       @endif
                            <div class="flex w-full rounded-lg mb-2 shadow-md overflow-hidden border border-gray-600 bg-white">
                                <div class="p-4 w-full">
                                    <div>
                                        <p class="font-mono text-gray-600">
                                            Commented On:
                                            <span class="text-indigo-600 capitalize">{{ $comment->commentable->name }}</span>
                                        </p>
                                        <p class="whitespace-pre-line font-mono">
                                            {{ $comment->body }}
                                        </p>
                                    </div>
                                    <div class="flex justify-between mt-3 text-gray-600">
                                        <div>
                                            {{ $comment->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        @if(auth()->id() === $user->id)
                            <p class="block mx-auto p-4 text-center font-mono text-indigo-600">You don't have any activity...</p>
                        @else
                            <p class="block mx-auto p-4 text-center font-mono text-indigo-600">There's no activity for this user...</p>
                        @endif
                    @endforelse
                </div>
			</div>
			<div class="col-12 md:col-6 mt-6 md:mt-0">
                <h2 class="mb-3 uppercase font-mono font-semibold text-lg text-center text-indigo-600">Beers</h2>
				@forelse ($user->beers as $beer)
					<a href="{{ route('beers.show', $beer->slug) }}" class="block rounded-lg mb-2 overflow-hidden border border-gray-200 shadow-md hover:shadow-lg hover:border-indigo-600 transition ease-in duration-100 bg-white">
						<div class="px-6 py-6">
							<span class="uppercase text-indigo-400 font-mono font-bold text-xs">{{ $beer->style->name }}</span>
							<div class="font-bold font-mono text-xl mt-2 mb-2 text-indigo-600 capitalize">{{ $beer->name }}</div>
							<p class="text-gray-700 font-mono tracking-tight text-sm leading-tight lowercase">{{ Str::limit($beer->notes, 50) }}</p>
							<p class="text-gray-700 text-base mt-2 leading-tight">{{ \Str::limit($beer->description, 90) }}</p>
							<div class="mt-4 flex justify-between">
								<span class="font-bold text-gray-600">OG: 1.06</span>
								<span class="font-bold text-gray-600">FG: 1.002</span>
							</div>
							<div class="mt-4 flex justify-between">
								<span class="font-bold text-gray-600">ABV: 6.0</span>
								<span class="font-bold text-gray-600">IBU: 35</span>
							</div>
						</div>
					</a>
                @empty
                    @if(auth()->id() !== $user->id)
                        <div class="block rounded-lg mb-2 overflow-hidden border border-gray-600 shadow-md bg-white">
                            <div class="px-6 py-6">
                                <div class="flex justify-between mb-6">
                                    <span class="inline-block bg-gray-300 rounded h-3 w-2/3"></span>
                                </div>
                                <div class="flex justify-between mb-6">
                                    <span class="inline-block bg-gray-300 rounded h-3 w-1/2"></span>
                                    <span class="inline-block bg-gray-300 rounded h-3 w-1/3"></span>
                                </div>
                                <div class="flex justify-between mb-6">
                                    <span class="inline-block bg-gray-300 rounded h-3 w-1/4"></span>
                                    <span class="inline-block bg-gray-300 rounded h-3 w-1/4"></span>
                                    <span class="inline-block bg-gray-300 rounded h-3 w-1/4"></span>
                                </div>
                                <p class="text-center font-mono leading-normal">
                                    This user hasn't created any beers...
                                </p>
                            </div>
                        </div>
                    @endif
				@endforelse
                @if(auth()->id() === $user->id)
                    <a href="{{ route('beers.create') }}" class="block rounded-lg mb-2 overflow-hidden border border-gray-600 shadow-md bg-white">
                        <div class="px-6 py-6">
                            <div class="flex justify-between mb-6">
                                <span class="inline-block bg-gray-300 rounded h-3 w-2/3"></span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span class="inline-block bg-gray-300 rounded h-3 w-1/2"></span>
                                <span class="inline-block bg-gray-300 rounded h-3 w-1/3"></span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span class="inline-block bg-gray-300 rounded h-3 w-1/4"></span>
                                <span class="inline-block bg-gray-300 rounded h-3 w-1/4"></span>
                                <span class="inline-block bg-gray-300 rounded h-3 w-1/4"></span>
                            </div>
                            @if(count($user->beers))
                                <p class="text-center font-mono text-indigo-600 leading-normal">
                                    Create a new beer!
                                </p>
                            @else
                                <p class="text-center font-mono leading-normal">
                                    You haven't created any beers yet <br>
                                    <span class="text-indigo-600">
                                        create one now!
                                    </span>
                                </p>
                            @endif
                        </div>
                    </a>
                @endif
			</div>
		</div>
	</div>
@endsection
