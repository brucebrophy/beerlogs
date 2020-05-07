@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="md:col-8 md:offset-2 lg:col-6 lg:offset-3">
                <div class="flex flex-col mt-8 break-words bg-white border border-2 rounded shadow-md">
                    <div class="font-semibold bg-indigo-800 text-white font-mono uppercase py-3 px-6 mb-0">
                        {{ __('Login') }}
                    </div>
                    <form class="w-full p-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="font-mono text-sm text-indigo-600 block uppercase">
                                {{ __('E-Mail Address') }}:
                            </label>
                            <input id="email" type="email" class="form-input font-mono text-sm w-full border mt-2 @error('email') border-red-600 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                            <input id="password" type="password" class="form-input font-mono text-sm w-full border mt-2 @error('password') border-red-500 @enderror" name="password" required>
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex mb-6">
                            <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                                <input type="checkbox" name="remember" id="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <span class="ml-2 font-mono text-sm uppercase">{{ __('Remember Me') }}</span>
                            </label>
                        </div>
                        <div>
                            <button type="submit" class="px-8 w-full py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">
                                {{ __('Login') }} ->
                            </button>
                        </div>
                        <div class="flex flex-col items-center">
                            <a class="block text-sm font-mono text-indigo-600 mt-4 hover:text-blue-700 no-underline" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            <span class="block font-mono font-semibold text-sm text-gray-500 my-2"> - OR -</span>
                            <a class="block text-sm font-mono text-indigo-600 hover:text-blue-700 no-underline" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
