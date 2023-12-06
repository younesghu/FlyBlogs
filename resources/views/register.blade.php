<script src="https://cdn.tailwindcss.com"></script>

<body>


        {{-- @if(Auth::check()) <!-- Check if the user is logged in -->
        <p>Hello mister <strong><u>{{ Auth::user()->name }}</u></p>
        @endif --}}

        {{-- <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form> --}}
{{--
        <form action="/store" method="POST">
            @csrf
            <div>
                <label for="title">Blog Title</label>
                <div class="input">
                    <input id="title" type="text" name="title" required>
                </div>
            </div>
            <div>
                <label for="title">Blog Content</label>
                <div class="input">
                    <input id="content" type="text" name="content" required>
                </div>
            </div>
            <div>
                <label for="categories">Blog Category</label>
                <div class="input">
                    <input id="categories" type="text" name="categories" required>
                </div>
            </div>
            <button type="submit">Add Blog</button>

        </form> --}}

        {{-- <div class="container">
            <form class="form" action="/register" method="POST">
            @csrf
                <div>
                    <label for="name">Name</label>
                    <div class="input">
                        <input id="name" type="text" name="name" required>
                    </div>
                </div>
                <div>
                    <label for="email">Email</label>
                    <div class="input">
                        <input id="email" type="email" name="email" required>
                    </div>
                </div>
                <div>
                    <label for="password">Password</label>
                    <div class="input">
                        <input id="password" type="password" name="password" required>
                    </div>
                </div>
                <button type="submit">Register</button>
                <a href="/login">login</a>
            </form>
        </div> --}}
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Flowbite
                </a>
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Create and account
                        </h1>
                        <form class="space-y-4 md:space-y-6" method="POST" action="/users" >
                            @csrf
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Username</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name" required="">
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Already have an account? <a href="/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
          </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>
</html>
