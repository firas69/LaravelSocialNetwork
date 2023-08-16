

<div x-data="{show: false}"  @click.away="show = false">
    <button @click="show= !show " class="py-2 pl-3 pr-9 text-sm font-semibold w-60  inline-flex" > {{  isset($currentCategory)   ? $currentCategory->name : 'Category'}} <x-icon type="arrowD"/>
    </button>
    <div x-show="show" class="py-1 absolute w-full bg-gray-100 mt-2 rounded-xl z-50 overflow-auto max-h-52 "  style="display: none">
        @if(isset($currentCategory) or request('search') or request('page'))
            <a href="/" class="block text-left text-sm leading-5 px-3  hover:bg-gray-300 focus:bg-gray-300">{{ucwords("all")}}</a>
        @endif

        @foreach($categories as $category)
            <a href="?category={{$category->slug}}&{{http_build_query(request()->except('category'))}}" class="block text-left text-sm leading-5 px-3  hover:bg-gray-300 focus:bg-gray-300
                                {{ isset($currentCategory) && $currentCategory->is($category) ? "bg-blue-500 text-white" : '' }}">
                {{ucwords($category->name)}}
            </a>
        @endforeach
    </div>
</div>



