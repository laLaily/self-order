<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>

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

    <style>
        input[type="text"]{
            width: 30px;
            border: none;
            text-align: center;
        }
        input[type="text"]:focus, button{
            outline: none;
            box-shadow: none;
        }
    </style>

</head>
<body>
<nav class="navbar sticky-top" style="background-color: #efefef">
    <div class="container">
        <a class="navbar-brand" href="/dinein/order/products">
            <img src="{{asset('/logo.jpg')}}" alt="Logo" width="40" class="d-inline-block align-text-center p-0">
            Flower Cafe
        </a>
        <div class="navbar-nav pe-3">
            {{--            <a type="button" class="btn position-relative border border-dark btn-light" href="#">--}}
            {{--                <i class="bi bi-cart text-black fs-5"></i>--}}
            {{--                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="total-item">--}}
            {{--                    0--}}
            {{--                <span class="visually-hidden">Total Cart</span>--}}
            {{--                </span>--}}
            {{--            </a>--}}
        </div>
    </div>
</nav>

<div class="container pt-4" >
    <div class="row justify-content-center gap-4" id="products">

    </div>
    <div class="container sticky-bottom text-end pb-3 ">
        <a type="button" class="btn position-relative p-0 m-0" href="#" id="checkout">
            <i class="bi bi-cart text-success fs-1">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border-1 bg-warning p-1 text-black fs-6" id="total-item">
                    0
                <span class="visually-hidden">Total Cart</span>
            </span>
            </i>
        </a>
    </div>
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
                            <div class="card col-8 col-md-5 col-xl-3 col-xxl-3 rounded-3 p-0 border-0 border-bottom shadow-sm">
                                <div class="position-relative">
                                    <img src="{{asset('/makanan.jpg')}}" class="card-img-top rounded-5" alt="card-img">
                                    <span class="position-absolute top-100 start-100 translate-middle d-flex flex-row pb-2 rounded-pill mt-5" style="padding-right:6rem">
                                            <button type="button" class="btn btn-danger border p-0 fs-3 me-1 rounded-circle edit-product" id="${product.id}"
                                            value="-1"><i class="bi bi-dash"></i></button>
                                            <input type="text" class="text-primary" value="${product.total??0}" id="inp-${product.id}" disabled>
                                            <button type="button" class="btn btn-success border p-0 fs-3 ms-1 rounded-circle edit-product" id="${product.id}"
                                            value="1"><i class="bi bi-plus"></i></button>
                                    </span>
                                </div>

                                <div class="card-body">
                                    <p class="card-text pb-0 mb-0">${product.productName}</p>
                                    <p class="card-text fw-bold">${product.priceView}</p>
                                </div>
                            </div>
                        `
                }
                content.innerHTML = card
                $('#products').on('click', '.edit-product', function() {
                    sendEvent(this)
                });
            }
        })
        sendEvent(this)
    });


    async function getProduct(url){
        const response = await fetch(url);
        const json = await response.json()
        return await json;
    }

    function sendEvent(el){
        $.ajax({
            url: '/api/cart',
            method: 'GET',
            data: {
                productId: el.id,
                quantity: el.value,
            },
            success: function (data){
                if(data.status === 'success'){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false
                    })
                }

                if(data.transactionId){
                    $('#checkout').attr('href', '/checkout/' + data.transactionId)
                }


                const value = document.getElementById('inp-'+el.id)?.value ?? 0
                if(value)
                    document.getElementById('inp-'+el.id).value = parseInt(value) + parseInt(el.value)

                $('#total-item').html(data.total)
            },
            error: function (data){
                console.info(data)
                const response = JSON.parse(data.responseText)
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: response.message,
                    showConfirmButton: false
                })
            }
        })
    }


</script>
</html>
