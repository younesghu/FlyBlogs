<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    @auth

        {{-- @if(Auth::check()) <!-- Check if the user is logged in -->
        <p>Hello mister <strong><u>{{ Auth::user()->name }}</u></p>
        @endif --}}

        {{-- <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form> --}}

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

        </form>

    @else
        <div class="container">
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
        </div>
    @endauth

</body>
</html>
