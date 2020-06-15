@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<div class="row">
			<div class="md:col-4">
				<div class="bg-indigo-600 rounded-lg shadow-lg">
					<div class="p-6">
						<div class="mx-auto inline-block">
							<h1 class="font-mono font-semibold text-white text-xl">
								{{ $user->username }}
							</h1>
							<p class="block mt-2 font-mono text-white opacity-75">Member Since {{ $user->created_at->diffForHumans() }}</p>
						</div>
					</div>
				</div>
                @can('update', $user)
                    <a href="{{ route('users.edit', $user) }}" class="block mt-3 px-8 py-3 border-2 border-indigo-600 text-indigo-600 text-center font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Edit Profile</a>
                @endcan
			</div>
            <div class="md:col-8">
                <div class="border-b border-indigo-600">
                    <div class="flex overflow-x-scroll">
                        <div class="p-3 {{ !request()->has('tab') ? 'border-b-2 border-indigo-900' : '' }}">
                            <a href="{{ route('users.show', $user->username) }}" class="p-3 mx-2 inline-block font-mono">Overview</a>
                        </div>
                        <div class="p-3 {{ request()->get('tab') === 'comments' ? 'border-b-2 border-indigo-900' : '' }}">
                            <a href="{{ route('users.show', [$user->username, 'tab' => 'comments']) }}" class="p-3 mx-2 inline-block font-mono">Comments</a>
                        </div>
{{--                        <div class="p-3">--}}
{{--                            <a href="{{ route('users.show', $user->username) }}" class="p-3 mx-2 inline-block font-mono">Logs</a>--}}
{{--                        </div>--}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mt-6">
                            @if(! request()->has('tab'))
                                @foreach ($user->beers as $beer)
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
                                @endforeach
                            @endif
                            @if(request()->get('tab') === 'comments')
                                @foreach($user->comments as $comment)
                                    @if($comment->commentable_type = 'App\Beers\Beer')
                                    <a href="{{ route('beers.show', $comment->commentable->slug) }}" class="block rounded-lg mb-2 overflow-hidden border border-gray-200 shadow-md hover:shadow-lg hover:border-indigo-600 transition ease-in duration-100 bg-white">
                                    @endif
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
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
    <div class="row">

    </div>
@endsection
