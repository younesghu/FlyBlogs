@vite('resources/css/app.css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">

<body class="min-h-screen flex flex-col">
    <main class="flex-grow bg-white">

        {{-- Navbar --}}
        <nav class="bg-gray-100 relative shadow-md">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/" class="flex items-center">
                    <span class="self-center text-2xl hover:text-gray-500 font-bold whitespace-nowrap">
                        FlyBlogs
                        <i class="fa fa-plane" aria-hidden="true"></i>
                    </span>
                </a>
                @auth
                    {{-- Notifications  --}}
                    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse relative">
                        <div class="relative">
                            <button id="notificationButton" class="relative z-20 block p-2 text-gray-900 rounded-full focus:outline-none">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge badge-light">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </button>
                            <div id="notificationMenu" class="hidden absolute right-0 mt-2 w-64 bg-white divide-y divide-gray-100 border border-gray-300 rounded-lg shadow z-30">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <a href="/blogs/{{ $notification->data['blog_id'] }}">
                                        <div class="p-4 border-b border-gray-300 hover:bg-gray-100">
                                            {!! $notification->data['message'] !!}
                                        </div>
                                    </a>
                                @empty
                                    <div class="p-4 text-gray-600">You don't have any notifications yet.</div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Dropdown User Picture Button --}}
                        <button type="button" class="flex text-sm bg-gray-500 rounded-full md:me-0" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="{{auth()->user()->user_img ? asset('storage/' . auth()->user()->user_img) : asset('images/img.webp')}}" alt="user photo">
                        </button>

                        {{-- Dropdown Menu for User Picture --}}
                        <div class="z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 border border-gray-300 rounded-lg shadow w-50 min-w-[200px]" id="user-dropdown">
                            <div class="px-4 py-3">
                                <span class="block text-base font-bold text-gray-700">{{auth()->user()->name}}</span>
                                <span class="block text-sm text-gray-500">{{auth()->user()->email}}</span>
                            </div>
                            <ul class="py-2" aria-labelledby="user-menu-button">
                                <li>
                                    <a href="/users/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a>
                                </li>
                                <li>
                                    <a href="/accounts" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Social Accounts</a>
                                </li>
                                <li>
                                    <a href="/blogs/manage" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Blogs</a>
                                </li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                        <a href="/register">
                            <button type="button" class="text-white bg-gray-400 border border-gray-400 hover:border-gray-500 hover:text-gray-800 focus:outline-none font-medium rounded text-sm px-4 py-2.5 text-center me-2 mb-2">Register</button>
                        </a>
                        <a href="/login">
                            <button type="button" class="text-white bg-gray-400 border border-gray-400 hover:border-gray-500 hover:text-gray-800 focus:outline-none font-medium rounded text-sm px-4 py-2.5 text-center me-2 mb-2">Login</button>
                        </a>
                    </div>
                @endauth

                {{-- Navbar Button Options --}}
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg bg-transparent md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0">
                        <li>
                            <a href="/" class="block py-2 px-3 text-gray-900 rounded hover:text-gray-500 md:p-0  {{ Request::is('/') ? 'underline' : '' }}" aria-current="page">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="/about" class="block py-2 px-3 text-gray-900 rounded hover:text-gray-500 md:p-0  {{ Request::is('about') ? 'underline' : '' }}">
                                About App
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="/blogs/create" class="block py-2 px-3 text-gray-900 rounded hover:text-gray-500 md:p-0  {{ Request::is('blogs/create') ? 'underline' : '' }}">
                                    Create Blog
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-lg mx-auto my-6">
            @yield('content')
        </div>

    </main>

    {{-- Footer --}}
    <footer class="bg-gray-100">
        <div class="mx-auto w-full max-w-screen-xl p-4 lg:py-8">
            <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
            <div class="flex justify-between items-center">
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024
                    <a href="https://www.linkedin.com/in/younes-guigaho/" class="hover:underline" target="_blank">Guigaho Younes</a>. All Rights Reserved.
                </span>
                <div class="flex space-x-4">
                    <a href="https://github.com/younesghu" class="text-gray-500 hover:underline" target="_blank">GitHub</a>
                    <a href="mailto:younes.guigaho.biz@gmail.com" class="text-gray-500 hover:underline" target="_blank">Contact Me</a>
                </div>
            </div>
        </div>
    </footer>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationButton = document.getElementById('notificationButton');
        const notificationMenu = document.getElementById('notificationMenu');

        // Toggle dropdown visibility
        notificationButton.addEventListener('click', function(event) {
            event.stopPropagation();
            if (notificationMenu.classList.contains('hidden')) {
                notificationMenu.classList.remove('hidden');
            } else {
                notificationMenu.classList.add('hidden');
            }
        });

        // Close the dropdown if clicked outside
        document.addEventListener('click', function(event) {
            if (!notificationButton.contains(event.target) && !notificationMenu.contains(event.target)) {
                notificationMenu.classList.add('hidden');
            }
        });
    });
</script>
