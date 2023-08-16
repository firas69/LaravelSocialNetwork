@props(['post', 'comments'])

<article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
    <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
        <img src="/storage/images/{{$post->image}}" alt="" class="rounded " style="width: 550px;height: 250px">

        <p class="mt-4 block text-gray-400 text-xs">
            Published <time>{{$post->created_at}}</time>
        </p>

        <div class="flex items-center lg:justify-center text-sm mt-4">
            <img src="/storage/images/{{$post->user->image}}" class="w-12 h-12 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500" alt="Lary avatar">
            <div class="ml-3 text-left">
                <a href="{{url('/')}}?author={{$post->user->user_name}}"><h5 class="font-bold">{{$post->user->name}}</h5></a>
            </div>
        </div>
    </div>

    <div class="col-span-8">
        <div class="hidden lg:flex justify-between mb-6">
            <a href="/"
               class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                <x-icon type="arrowL"/>

                Back to Posts
            </a>

            <div class="space-x-2">
                <a href="#"
                   class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                   style="font-size: 10px">{{$post->category->name}}</a>

            </div>
        </div>

        <h1 class="font-bold text-3xl lg:text-4xl mb-10">
            {{$post->title}}
        </h1>

        <div class="space-y-4 lg:text-lg leading-loose">
            <p>{{$post->body}}</p>

        </div>

    </div>

</article>
@php
    $comments = $post->comment()->orderBy('created_at', 'desc')->get();
    if ($comments){
        $numberOfComments = $comments->count();
    }

@endphp

<section class="bg-gray-100 dark:bg-gray-900 py-8 lg:py-16 rounded border-3 border-gray-500">
    <div style="max-height: 30rem" class="max-w-2xl mx-auto px-4 rounded border-3 border-gray-500 overflow-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion ({{$numberOfComments ? $numberOfComments : '0'}})</h2>
        </div>
        <form class="mb-6" method="POST" action="/comment" >
            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                @csrf
                <input hidden name="post_id" value="{{$post->id}} ">
                <input hidden name="user_id" value="{{auth()->id()}} ">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea id="comment" rows="6"
                          class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                          name="body" placeholder="Write a comment..." required></textarea>
            </div>
            <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-400 hover:bg-blue-200 hover:text-black rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Post comment
            </button>
        </form>


        @foreach($comments as $comment)
            <x-comment :comment="$comment"/>
        @endforeach

    </div>
</section>
