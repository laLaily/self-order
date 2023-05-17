<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Registration</title>

</head>
<body>
        <form action="{{route("addCustomer")}}" method="post">
            @csrf
            <div class="mb-3 d-flex justify-content-center align-items-center">
                <h1>Order Dine-In</h1>
            </div>
            <div class="mb-3">
                <label for="customerName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="customerName" name="customerName" placeholder="name">
            </div>
            <div class="mb-3">
                <label for="customerPhone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="customerPhone" name="customerPhone" placeholder="phone">
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button class=" btn " style="width: 150px; background: #483434; color:#EED6C4" type="submit">Order</button>
            </div>
        </form>
</body>
</html>
