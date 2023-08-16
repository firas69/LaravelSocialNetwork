<!doctype html>
<header>
    <title>Laravel From Scratch Blog</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</header>

<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div >
            <a href="/">
                <img src="/images/logo.png" alt="Laracasts Logo" width="100" height="10">
            </a>
        </div>

        <div class="mt-8 md:mt-0 flex">
            @guest
                <a href="/login" class="text-xs font-bold uppercase py-3 px-5">LOGIN</a>
                <a href="/register" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Register
                </a>

            @else
                <div class="flex items-right space-x-4 relative">
                    <div x-data="{ show: false }" @click.away="show = false">
                        <button @click="show = !show" class="w-16 h-16 py-1 px-1 rounded-full border-2  border-black ">
                            <img src="{{ url('/').'/storage/images/' . auth()->user()->image }}" class=" rounded-full hover:opacity-80">
                        </button>
                        <div x-show="show" class="py-1 absolute right-0 mt-2 z-50 overflow-auto max-h-52 w-48 bg-white border border-gray-300 rounded shadow-lg" style="display: none">
                            <form action="/myPosts" method="Get" class="p-2">
                                <input type="submit" value="My Posts" class="w-full text-xs font-bold uppercase bg-blue-400 px-4 py-2 rounded hover:bg-blue-200 cursor-pointer">
                            </form>
                            <form action="/logout" method="POST" class="p-2">
                                @csrf
                                <input type="submit" value="Log Out" class="w-full text-xs font-bold uppercase bg-red-600 px-4 py-2 rounded hover:bg-black hover:text-white cursor-pointer">
                            </form>

                        </div>
                    </div>
                </div>

            @endguest



        </div>
    </nav>


    @yield('content')


    <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <img src="./images/newsletter-icon.png" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="text-sm">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">
                <form method="POST" action="/newsletter" class="lg:flex text-sm">
                    @csrf
                    <div class="lg:py-3 lg:px-5 flex items-center">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                        </label>

                        <input id="email" type="text" placeholder="Your email address"
                               class="lg:bg-transparent pl-4 focus-within:outline-none"
                                name="email">
                    </div>

                    <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </footer>

</section>
</body>
