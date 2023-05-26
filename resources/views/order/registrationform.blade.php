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
    <div class="container h-100">
        <div class="row d-flex justify-content-center h-75 align-content-center">
            <div class="col-8">
                <div class="card mt-5">
                    <div class="card-header">
                        <h5 class="mt-2">Order Dine-In</h5>
                    </div>
                    <div class="card-body shadow-sm">
                        <form action="{{route("addCustomer")}}" method="post">
                            @csrf
                            <div class="mb-3 d-flex justify-content-center align-items-center">

                            </div>
                            <div class="mb-3">
                                <label for="customerName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="customerName" name="customerName" placeholder="name" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="customerPhone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="customerPhone" name="customerPhone" placeholder="phone" autocomplete="off">
                            </div>
                            <button class="btn btn-light" type="submit" style="background: #efefef">Order Sekarang</button>
{{--                            <div class="d-flex justify-content-center align-items-center">--}}
{{--                                <button class=" btn " style="width: 150px; background: #483434; color:#EED6C4" type="submit">Order Sekarang</button>--}}
{{--                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
