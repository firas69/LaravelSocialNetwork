@props(['comment'])
<article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
    <footer class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
                    class="mr-2 w-6 h-6 rounded-full"
                    src="{{'../storage/images/' .$comment->user->image}}"
                    alt="Michael Gough">{{$comment->user->name}}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="{{$comment->created_at}}"
                                                                      title="{{$comment->created_at}}">{{$comment->created_at->diffForHumans()}}</time></p>
        </div>
        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                type="button">
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                </path>
            </svg>
            <span class="sr-only">Comment settings</span>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownComment1"
             class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownMenuIconHorizontalButton">
                <li>
                    <a href="#"
                       class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                </li>
                <li>
                    <a href="#"
                       class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                </li>
                <li>
                    <a href="#"
                       class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                </li>
            </ul>
        </div>
    </footer>
    <p class="text-gray-500 dark:text-gray-400">{{$comment->body}}</p>
    @auth
        <div class="flex fle items-center mt-4 space-x-4" x-data="{show: false}"  >
            <button type="button"
                    class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400"
                    @click="show= !show " >
                <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                Reply
            </button>
            <form x-show="show" style="display: none" method="POST" action="/reply">
                @csrf
                <div class="flex space-x-2">
                    <input type="text" placeholder="Comment here" name="body" class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <input type="submit" value="Respond" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 cursor-pointer">
                </div>
                @auth
                    <input hidden type="number" value="{{auth()->user()->id}}" name="user_id">
                    <input hidden type="number" value="{{$comment->id}}" name="comment_id">
                @endauth
            </form>

        </div>
    @endauth
    <div >
        @php
            $replies = $comment->reply()->orderBy('created_at', 'desc')->get();
        @endphp

        @foreach($replies as $reply)
            <x-reply :reply="$reply"/>
        @endforeach
    </div>
</article>
