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
    {{-- <form action="">
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Register</button>
    </form> --}}
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
    </form>
    </div>

</body>
</html>
