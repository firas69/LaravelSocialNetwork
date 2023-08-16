@extends('layout')

@section('content')
    <main class="flex items-center justify-center h-auto  my-20">
        <form class="w-1/3 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4   bg-gray-100" action="/login" method="POST">
            @csrf
            @if ($errors->has('message'))
                <h3>{{ session('message') }}</h3>
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email" name="email" value="{{old('email')}}">
                @error('email')
                {{$message}}
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="******************">
                @error('password')
                {{$message}}
                @enderror

            </div>
            <div class="flex items-center justify-between">
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value=" Sign In" >

                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    Forgot Password?
                </a>
            </div>
        </form>
    </main>
@endsection
