@props(['reply'])

<div class="text-gray-300 font-bold pl-14">|</div>
<div class="flex justify-between border ml-5  rounded-md">

    <div class="p-3">
        <div class="flex gap-3 items-center">
            <img src="{{'../storage/images/' .$reply->user->image}}"
                 class="object-cover w-10 h-10 rounded-full border-2 border-emerald-400  shadow-emerald-400">
            <h3 class="font-bold">
                {{$reply->user->name}}
                <br>
                <span class="text-sm text-gray-400 font-normal">{{$reply->created_at}}</span>
            </h3>
        </div>
        <p class="text-gray-600 mt-2">
            {{$reply->body}}
        </p>
    </div>



</div>

