<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>
</head>
<body>
    <form action="{{route('loginAdmin')}}" method="post">
        @csrf
        <label>Username</label>
        <input name="username" type="text">
        <label>Password</label>
        <input name="password" type="password">
        <button type="submit">Login Admin</button>
    </form>
</body>
</html>
