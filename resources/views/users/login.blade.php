<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<section class="bg-gray-100">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-gray-50 rounded-sm shadow border border-gray-700 md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Log in to your account
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="/users/authentificate">
                    @csrf
                    <div>
                        <label for="loginname" class="block mb-2 text-sm font-medium text-gray-900">Your Name</label>
                        <input type="text" name="loginname" id="loginname" class="bg-white border border-gray-500 text-gray-900 sm:text-sm block w-full p-2.5 focus:outline-none" placeholder="name" required="">
                    </div>
                    <div>
                        <label for="loginpassword" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="loginpassword" id="loginpassword" placeholder="••••••••" class="bg-white border border-gray-500 text-gray-900 sm:text-sm block w-full p-2.5 focus:outline-none" required="">
                    </div>
                    <button type="submit" class="w-full bg-gray-200 text-gray-900 font-medium text-sm px-5 py-2.5 text-center">Log in</button>
                    <p class="text-sm font-light text-gray-500">
                        Don’t have an account yet? <a href="/register" class="font-semibold text-gray-600 underline">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</html>
