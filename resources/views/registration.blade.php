@extends('layout')

@section('content')
    <main class=" mt-xl-5 position-relative" >
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Register!</h1>
            <form method="POST" action="/register" class="mt-10" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="name"
                    >
                        Name
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="name"
                           id="name"
                           required
                    >
                    @error('name')
                    {{$message}}
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="user_name"
                    >
                        Username
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="user_name"
                           id="user_name"
                           required
                    >
                    @error('user_name')
                    {{$message}}
                    @enderror
                </div>


                <div class="mb-6 p-0">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="image"
                    >
                        Image
                    </label>
                    <input class="block p-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           type="file"
                           name="image"

                           id="image"

                           required
                    >
                    @error('image')
                    {{$message}}
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="email"
                    >
                        Email
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="email"
                           name="email"
                           id="email"
                           required
                    >
                    @error('email')
                    {{$message}}
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="password"
                    >
                        Password
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="password"
                           name="password"
                           id="password"
                           required
                    >
                    @error('password')
                    {{$message}}
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </main>
    </main>
@endsection
