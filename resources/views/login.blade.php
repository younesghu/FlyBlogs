<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form class="form" action="/authentificate" method="POST">
            @csrf
            <div>
                <label for="loginname">Name</label>
                <div class="input">
                    <input id="loginname" type="text" name="loginname" required>
                </div>
            </div>
            <div>
                <label for="loginpassword">Password</label>
                <div class="input">
                    <input id="loginpassword" type="password" name="loginpassword" required>
                </div>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
