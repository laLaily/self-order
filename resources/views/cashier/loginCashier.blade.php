<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Georgia, 'Times New Roman', Times, serif
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(bg.png);
        }

        .container {
            width: 100%;
            display: flex;
            max-width: 850px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .login {
            width: 400px;
        }

        form {
            width: 250px;
            margin: 60px auto;
        }

        h1 {
            margin: 20px;
            text-align: center;
            font-weight: bolder;
            text-transform: uppercase;
        }

        hr {
            border-top: 2px solid #EED6C4;
        }

        p {
            text-align: center;
            margin: 10px;
        }

        .right img {
            width: 430px;
            height: 100%;
            border-top-right-radius: 20px;
        }

        form label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            padding: 5px;
        }

        input {
            width: 100%;
            margin: 2px;
            border: none;
            outline: none;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #6B4F4F;
        }

        button {
            border: none;
            outline: none;
            padding: 8px;
            width: 250px;
            color: black;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            border-radius: 5px;
            border: 2px solid #EED6C4;
            background-color: #950101;
        }

        button:hover {
            background: #3D0000;
        }
    </style>

</head>

<body>
<div class="container">
    <div class="login">
        <form action="{{route('loginCashier')}}" method="post">
            @csrf
            <h1>Login</h1>
            <hr>
            <p>Login Cashier Flower Cafe</p>
            <label for="username">Username</label>
            <input name="username" type="text">
            <label for="password">Password</label>
            <input name="password" type="password">
            <button type="submit">Login</button>
        </form>
    </div>
    <div class="right">
        <img src="kasir.png" alt="">
    </div>
</div>
</body>


</html>




