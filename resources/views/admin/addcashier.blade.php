<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Cashier</title>
</head>
<body>
    <form method="post" action="{{route('addCashier')}}">
        @csrf
        <label>Name</label>
        <input name="cashierName" type="text">
        <label>Phone</label>
        <input name="cashierPhone" type="text">
        <label>Username</label>
        <input name="username" type="text">
        <label>Password</label>
        <input name="password" type="password">
        <button type="submit">Add</button>
    </form>
</body>
</html>
