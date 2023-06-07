<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Thank You For Order</p>
    <p>Your payment code is : {{session('paymentCode') ?? ''}}</p>
    <p></p>
    <div class="card-body">
        {!! QrCode::size(300)->generate("http://127.0.0.1:8000/dinein/order/success?" . session('paymentCode')) !!}
    </div>
</body>
</html>
