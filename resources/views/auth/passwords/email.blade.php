@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="md:col-8 md:offset-2 lg:col-6 lg:offset-3">
                @if (session('status'))
                    <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="flex flex-col break-words mt-8 bg-white border border-2 rounded shadow-md">
                    <div class="font-semibold bg-indigo-800 text-white font-mono uppercase py-3 px-6 mb-0">
                        {{ __('Reset Password') }}
                    </div>
                    <form class="w-full p-6" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="font-mono text-sm text-indigo-600 block uppercase">
                                {{ __('E-Mail Address') }}:
                            </label>
                            <input id="email" type="email" class="form-input font-mono text-sm w-full border mt-2 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex justify-center flex-wrap">
                            <button type="submit" class="px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        
                            <p class="w-full font-mono text-xs text-center text-gray-700 mt-8 mb-0">
                                <a class="text-indigo-600 no-underline" href="{{ route('login') }}">
                                    {{ __('Back to login') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
