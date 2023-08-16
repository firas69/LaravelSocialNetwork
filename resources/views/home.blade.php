@extends('layout')

@section('content')
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Laravel From Scratch</span> News
        </h1>

        <p class="text-sm mt-14">
            Another year. Another update. We're refreshing the popular Laravel series with new content.
            I'm going to keep you guys up to speed with what's going on!
        </p>

        <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8 w-auto" style="display: flex; justify-content: space-around">

            <!-- Post Publish -->
            @auth
                <div class="relative flex lg:inline-flex items-center bg-blue-100 rounded-xl m-auto ">
                    <div x-data="{show: false}"  @click.away="show = false">
                        <button @click="show= !show " class="py-2 pl-3 pr-9 text-sm font-semibold w-40  inline-flex " > <span class="text-center">Post</span>
                        </button>
                        <div x-show="show" class=" absolute w-50  mt-2 rounded-xl z-50  "  style="display: none">
                            <form method="POST" action="/post" class="mt-3  " enctype="multipart/form-data" x-show="show" enctype="multipart/form-data">
                                <div class=" absolute editor mx-auto w-auto flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl bg-white" style="position:absolute;
                            width: 700px; margin: auto">
                                    @csrf
                                    <input hidden name="user_id" value="{{auth()->id()}} ">
                                    <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" placeholder="Title" type="text" name="title" required>
                                    <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" placeholder="Excerpt" type="text" name="excerpt" hidden>
                                    <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" placeholder="Slug" type="text" name="slug" hidden>

                                    <label for="category" class="mt-3" >Choose a Category:</label>
                                    <select name="category_id" id="category" class="mb-4 mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <textarea name="body" class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false" placeholder="Describe everything about this post here" required></textarea>
                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-3" name="image" type="file" multiple>
                                    <!-- buttons -->
                                    <div class="buttons flex mt-4">
                                        <button @click="show= false " class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto" >Cancel</button>
                                        <button class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500" type="submit">Post</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endauth
            <!--  Category -->
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl m-auto">
                <x-dropdown :categories="$categories" :currentCategory="$currentCategory"/>
            </div>
            <!-- Search -->
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
                <form method="GET" action="">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{request('category')}}">
                    @endif
                    <input type="text" name="search" placeholder="{{request('search') ? request('search'):'Find something'}}"
                           class="bg-transparent placeholder-black font-semibold text-sm">
                </form>
            </div>

        </div>
        @if(session('message'))
            <div x-data="{show: true}"
                 x-init="setTimeout(()=>show=false,3000)"
                 x-show="show"
                 class="fixed">
                <div
                    class="font-regular relative block w-full max-w-screen-md rounded-lg bg-blue-500 px-4 py-4 text-base text-white m-lg-auto"
                    data-dismissible="alert">
                    <div class="absolute top-4 left-4">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            aria-hidden="true"
                            class="mt-px h-6 w-6"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </div>
                    <div class="ml-8 mr-12">
                        <h5 class="block font-sans text-xl font-semibold leading-snug tracking-normal text-white antialiased">
                            {{session('message')}}
                        </h5>

                    </div>
                    <div
                        data-dismissible-target="alert"
                        data-ripple-dark="true"
                        class="absolute top-3 right-3 w-max rounded-lg transition-all hover:bg-white hover:bg-opacity-20"
                    >

                    </div>
                </div>
            </div>
        @endif
    </header>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count()>0)
            <x-featured_card  :post="$posts[0]"/>
            @if($posts->count()>1)
                <div class="lg:grid lg:grid-cols-6 ">
                    @foreach($posts->skip(1) as $post)
                        <x-post_card :post="$post"  class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}" />
                    @endforeach
                </div>
            @endif
            {{$posts -> links()}}
        @else
            <h3>No posts available. Check later!</h3>
        @endif
    </main>
@endsection
