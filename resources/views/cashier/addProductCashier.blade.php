<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/templateHeader.css') }}">
    <link rel="stylesheet" href="{{ mix('css/templateFooter.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar sticky-top" style="background-color: #efefef">
    <div class="container">
        <a class="navbar-brand" href="/cashier/dashboard">
            <img src="{{asset('/logo.jpg')}}" alt="Logo" width="40" class="d-inline-block align-text-center p-0">
            Flower Cafe
        </a>
        <div class="navbar-nav pe-3">
            <a type="button" class="btn position-relative border border-dark btn-light" href="/cashier/product/view">
                View Product
            </a>
        </div>
    </div>
</nav>
<div class="container pt-4" >
    <div>
        <div class="row mb-2">
            <label for="staticEmail" class="col-sm-5 col-form-label">Product Name</label>
            <div class="col-sm-5">
                <input class="form-control" type="text" id="productName" name="productName">
            </div>
        </div>
        <div class="row mb-2">
            <label for="staticEmail" class="col-sm-5 col-form-label">Product Category</label>
            <div class="col-sm-5">
                <select class="form-control" name="productCategory" id="productCategory">
                    <option>Chose One</option>
                    <option value="Food">Food</option>
                    <option value="Beverage">Beverage</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label for="product-price" class="col-sm-5 col-form-label">Price</label>
            <div class="col-sm-5">
                <input class="form-control" type="number" id="productPrice" name="productPrice" min="1000" max="1000000">
            </div>
        </div>
        <div class="row mb-2">
            <label for="staticEmail" class="col-sm-5 col-form-label">Stock</label>
            <div class="col-sm-5">
                <input type="number" value="1" min="1" max="100" name="productStock" id="productStock" class="form-control">
            </div>
        </div>
        <div >
            <button class="btn btn-primary" id="addBtn">Add Product</button>
        </div>
    </div>

</div>

<script>
    $('#addBtn').click(function (){
        $.ajax({
            url: '/api/products',
            method: 'POST',
            header: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            data: {
                'productName': $('#productName').val(),
                'productCategory': $('#productCategory').val(),
                'productPrice': $('#productPrice').val(),
                'productStock': $('#productStock').val()
            },
            success: function (data){
                window.location.href = "/cashier/product/view";
            }
        })
    });
</script>
</body>
</html>
