{{--<html>--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Cashier Products</title>--}}

{{--    <link rel="stylesheet" href="{{ mix('css/templateHeader.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ mix('css/templateFooter.css') }}">--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>--}}
{{--    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">--}}

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

{{--</head>--}}
{{--<body>--}}
{{--<nav class="navbar sticky-top" style="background-color: #efefef">--}}
{{--    <div class="container">--}}
{{--        <a class="navbar-brand" href="/cashier/dashboard">--}}
{{--            <img src="{{asset('/logo.jpg')}}" alt="Logo" width="40" class="d-inline-block align-text-center p-0">--}}
{{--            Flower Cafe--}}
{{--        </a>--}}
{{--        <div class="navbar-nav pe-3">--}}
{{--            <a type="button" class="btn position-relative border border-dark btn-light" href="/cashier/product/add">--}}
{{--                Add Product--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}
{{--<br>--}}
{{--<div class="row justify-content-center gap-2" id="products">--}}

{{--</div>--}}

{{--</body>--}}

{{--<footer class="p-3 text-center">--}}
{{--    &copy; 2021--}}
{{--</footer>--}}
{{--<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>--}}
{{--<script>--}}

{{--    $(document).ready(function () {--}}
{{--        $.ajax({--}}
{{--            type: 'GET',--}}
{{--            url: '/api/products',--}}
{{--            success: function (data){--}}
{{--                const products = data.products--}}
{{--                const content = document.getElementById('products')--}}
{{--                let card = ''--}}
{{--                for (const product of products) {--}}
{{--                    card += `--}}
{{--                            <div class="card col-11 col-md-5 col-xl-3 col-xxl-3 p-1 rounded-3">--}}
{{--                                <img src="{{asset('/makanan.jpg')}}" class"card-img-top rounded-top" alt="card-img">--}}
{{--                                <div class="card-body">--}}
{{--                                    <p class="card-text text-center pb-0 mb-0">${product.productName}</p>--}}
{{--                                    <span class="font-monospace d-flex justify-content-center" style="font-size:14px">(${product.productCategory})</span>--}}
{{--                                    <p class="card-text text-end fw-bold text-center">${product.priceView}</p>--}}

{{--                                    <button type="button" class="text-center btn btn-light border d-flex ms-auto add-product ps-1 pe-1" value="${product.id}">--}}
{{--                                        <i class="bi bi-trash3"></i>--}}
{{--                                    </button>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        `--}}
{{--                }--}}
{{--                content.innerHTML = card--}}
{{--                $('#products').on('click', '.add-product', function() {--}}
{{--                    const value = $(this).val();--}}
{{--                    sendEvent(value)--}}
{{--                });--}}
{{--            }--}}
{{--        })--}}
{{--        sendEvent()--}}
{{--    });--}}

{{--    async function getProduct(url){--}}
{{--        const response = await fetch(url);--}}
{{--        const products = await response.json()--}}
{{--        return await products;--}}
{{--    }--}}

{{--    function sendEvent(btnValue){--}}
{{--        $.ajax({--}}
{{--            url: '/api/cart',--}}
{{--            method: 'GET',--}}
{{--            data: {--}}
{{--                productId: btnValue || 0,--}}
{{--                quantity: 1--}}
{{--            },--}}
{{--            success: function (data){--}}
{{--                if(data.status === 'success'){--}}
{{--                    Swal.fire({--}}
{{--                        position: 'center',--}}
{{--                        icon: 'success',--}}
{{--                        title: data.message,--}}
{{--                        showConfirmButton: false--}}
{{--                    })--}}
{{--                }--}}
{{--                $('#total-item').html(data.total)--}}
{{--            },--}}
{{--            error: function (data){--}}

{{--            }--}}
{{--        })--}}
{{--    }--}}
{{--</script>--}}
{{--</html>--}}

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cashier Products</title>

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

</head>
<body>
<nav class="navbar sticky-top" style="background-color: #efefef">
    <div class="container">
        <a class="navbar-brand" href="/cashier/dashboard">
            <img src="{{asset('/logo.jpg')}}" alt="Logo" width="40" class="d-inline-block align-text-center p-0">
            Flower Cafe
        </a>
        <div class="navbar-nav pe-3">
            <a type="button" class="btn position-relative border border-dark btn-light" href="/cashier/product/add">
                Add Product
            </a>
        </div>
    </div>
</nav>
<br>
<div class="row justify-content-center gap-2" id="products">

</div>

</body>

<footer class="p-3 text-center">
    &copy; 2021
</footer>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>

    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '/api/products',
            success: function (data){
                const products = data.products
                const content = document.getElementById('products')
                let card = ''
                for (const product of products) {
                    card += `
                            <div class="card col-11 col-md-5 col-xl-3 col-xxl-3 p-1 rounded-3">
                                <img src="{{asset('/makanan.jpg')}}" class"card-img-top rounded-top" alt="card-img">
                                <div class="card-body">
                                    <p class="card-text text-center pb-0 mb-0">${product.productName}</p>
                                    <span class="font-monospace d-flex justify-content-center" style="font-size:14px">(${product.productCategory})</span>
                                    <p class="card-text text-end fw-bold text-center">${product.priceView}</p>
                                    <button type="button" class="btn btn-danger text-center del-product" value="${product.id}">
                                    <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </div>
                        `
                }
                content.innerHTML = card
                $('#products').on('click', '.del-product', function() {
                    const value = $(this).val();
                    // console.log("value apa ini "+value);
                    sendEvent(value)
                });
            }
        })
        sendEvent()
    });

    async function getProduct(url){
        const response = await fetch(url);
        const products = await response.json()
        return await products;
    }

    function sendEvent(btnValue){
        $.ajax({
            url: '/api/products/' + btnValue,
            method: 'DELETE',
            data: {
                productId: btnValue
            },
            success: function (data){
                window.location.href = "/cashier/product/view";
            },
            error: function (data){

            }
        })
    }
</script>
</html>
