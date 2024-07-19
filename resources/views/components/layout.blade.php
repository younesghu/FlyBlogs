    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <nav class="bg-gray-100">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="" class="h-8" alt="LOGO" />
            <span class="self-center text-2xl hover:text-gray-500 font-semibold whitespace-nowrap">Blog App</span>
        </a>

        @auth
        {{-- Show this when logged in --}}
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button type="button" class="flex text-sm bg-gray-500 rounded-full md:me-0" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full" src="{{auth()->user()->user_img ? asset('storage/' . auth()->user()->user_img) : asset('images/profilepic.jpg')}}" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
            <div class="px-4 py-3">
                <span class="block text-base font-bold text-gray-700">{{auth()->user()->name}}</span>
                <span class="block text-sm text-gray-500">{{auth()->user()->email}}</span>
            </div>
            <ul class="py-2" aria-labelledby="user-menu-button">
                <li>
                <a href="/users/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Edit Profile</a>
                </li>
                <li>
                    <a href="/accounts" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Manage Social Accounts</a>
                </li>
                <li>
                    <a href="/blogs/manage" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Manage Blogs</a>
                </li>
                <li>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Sign out</button>
                </form>
                </li>
            </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="pl-4 items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg bg-transparent md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0">
                    <li>
                        <a href="/blogs/create" class="flex items-center py-2 px-3 text-gray-900 rounded hover:text-gray-500">
                            <span class="mr-2">Create</span>
                            <svg class="w-4 h-4 transform md:p-0 dark:border-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.546.5a9.5 9.5 0 1 0 9.5 9.5 9.51 9.51 0 0 0-9.5-9.5ZM13.788 11h-3.242v3.242a1 1 0 1 1-2 0V11H5.304a1 1 0 0 1 0-2h3.242V5.758a1 1 0 0 1 2 0V9h3.242a1 1 0 1 1 0 2Z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        @else
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                {{-- text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 --}}
                <a href="/register">
                    <button type="button" class="px-3 py-2 mr-2 text-xs font-medium text-center text-white bg-gray-600 rounded-md hover:bg-gray-500">
                        Sign up
                    </button>
                </a>

                <a href="/login">
                    <button type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-gray-600 rounded-md hover:bg-gray-500">
                        Log in
                    </button>
                </a>
            </div>
        @endauth

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
        <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg bg-transparent md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0">
            <li>
            <a href="/" class="block py-2 px-3 text-gray-900 rounded hover:text-gray-500 md:p-0" aria-current="page">Home</a>
            </li>
            <li>
            <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:text-gray-500 md:p-0">Categories</a>
            </li>
            <li>
            <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:text-gray-500 md:p-0">Pricing</a>
            </li>
            <li>
            <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:text-gray-500 md:p-0">Contact</a>
            </li>
        </ul>
        </div>
    </nav>

    <main class="bg-gray-100">

        @yield('content')

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
