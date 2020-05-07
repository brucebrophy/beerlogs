@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="md:col-8 md:offset-2 lg:col-6 lg:offset-3">
                <div class="flex flex-col mt-8 break-words bg-white border border-2 rounded shadow-md">
                    <div class="font-semibold bg-indigo-800 text-white font-mono uppercase py-3 px-6 mb-0">
                        {{ __('Register') }}
                    </div>
                    <form class="w-full p-6" method="POST" action="{{ route('register') }}">
                        @csrf
                         <div class="flex flex-wrap mb-6">
                            <label for="username" class="font-mono text-sm text-indigo-600 block uppercase">
                                Username:
                            </label>
                            <input id="username" type="text" class="form-input font-mono text-sm w-full border mt-2 @error('username') border-red-600 @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <label for="name" class="font-mono text-sm text-indigo-600 block uppercase">
                                {{ __('Name') }}:
                            </label>
                            <input id="name" type="text" class="form-input font-mono text-sm w-full border mt-2 @error('name') border-red-600 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-wrap mb-6">
                           <label for="email" class="font-mono text-sm text-indigo-600 block uppercase">
                                {{ __('E-Mail Address') }}:
                            </label>
                            <input id="email" type="email" class="form-input font-mono text-sm w-full border mt-2 @error('email') border-red-600 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <label for="password" class="font-mono text-sm text-indigo-600 block uppercase">
                                {{ __('Password') }}:
                            </label>
                            <input id="password" type="password" class="form-input font-mono text-sm w-full border mt-2 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <label for="password" class="font-mono text-sm text-indigo-600 block uppercase">
                                {{ __('Confirm Password') }}:
                            </label>
                            <input id="password-confirm" type="password" class="form-input font-mono text-sm w-full border mt-2 @error('password_confirmation') border-red-500 @enderror" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <button type="submit" class="px-8 w-full py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">
                            {{ __('Register') }}
                        </button>
                        <div class="flex flex-wrap">
                            <p class="w-full font-mono text-xs text-center text-gray-700 mt-8 mb-0">
                                {{ __('Already have an account?') }}
                                <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
