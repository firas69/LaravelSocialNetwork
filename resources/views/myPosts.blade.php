@extends('layout')

@props(['posts'])

@section('content')
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

    @foreach($posts as $post)
            <div class="max-w-4xl px-5  py-6 bg-white rounded-lg shadow-md bg-cover">
                <div x-data="{ show: false }" @click.away="show = false" class="flex justify-end px-4 pt-4 mb-4">
                    <button @click="show= !show "  class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                        <span class="sr-only">Open dropdown</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div x-show="show" class="z-10  text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 absolute mr-10">
                        <ul class="py-2">
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export Data</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="font-light text-gray-600">{{$post->created_at->diffForHumans()}}</span>
                    <a class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500" href="{{url('/')}}?category={{$post->category->slug}}">{{$post->category->name}}</a>
                </div>

                <div class="mt-2">
                    <h3 class="text-2xl text-gray-700 font-bold hover:text-gray-600" >{{$post->title}}</h3>
                    <p class="mt-2 text-gray-600">{{$post->excerpt}}</p>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <a class="text-blue-600 hover:underline" href="/post/{{$post->slug}}">Read more</a>
                    <div>
                        <a class="flex items-center" href="#">
                            <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="https://images.unsplash.com/photo-1502980426475-b83966705988?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=373&q=80" alt="avatar">
                            <h1 class="text-gray-700 font-bold">{{$post->user->name}}</h1>
                        </a>
                    </div>
                </div>
            </div>
    @endforeach

    </main>
@endsection
