<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cashier Dashboard</title>
</head>
<body>
    <a href="{{route('cashier.viewProducts')}}">Products {{$totalProducts}}</a>
    <a href="{{route('cashier.viewTransaction')}}">Transactions {{$totalTransactions}}</a>
</body>
</html>