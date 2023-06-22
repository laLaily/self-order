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

</head>
<body>
<nav class="navbar sticky-top" style="background-color: #efefef">
    <div class="container">
        <a class="navbar-brand" href="/dinein/order/products">
            <img src="{{asset('/logo.jpg')}}" alt="Logo" width="40" class="d-inline-block align-text-center p-0">
            Flower Cafe
        </a>
        <div class="navbar-nav pe-3">
            <a type="button" class="btn position-relative border border-dark btn-light" href="#">
                <i class="bi bi-cart text-black fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="total-item">
                    0
                <span class="visually-hidden">Total Cart</span>
                </span>
            </a>
        </div>
    </div>
</nav>

<div class="container pt-4" >
    <div class="row justify-content-center gap-2" id="products">

    </div>
</div>
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center mt-5">--}}
{{--            <div class="col-10">--}}
{{--                <div class="card shadow-sm">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="">--}}
{{--                            <!-- Filter -->--}}
{{--                            <form action="/api/cart" method="get">--}}
{{--                                <label for="filter">Pilih Kategori</label>--}}
{{--                                <div class="d-flex gap-2">--}}
{{--                                    <select name="filter" id="filter" class="form-select w-50">--}}
{{--                                        <option selected value="">All</option>--}}
{{--                                        <option value="beverage">Beverage</option>--}}
{{--                                        <option value="food">Food</option>--}}
{{--                                    </select>--}}
{{--                                    <button type="submit" class="btn btn-light border">--}}
{{--                                        Pilih--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                            <!-- Button trigger modal -->--}}
{{--                        </div>--}}

{{--                        <!-- Daftar Menu -->--}}
{{--                        <div class="products" >--}}
{{--                            <div class="card" style="width: 18rem;">--}}
{{--                                <img src="..." class="card-img-top" alt="...">--}}
{{--                                <div class="card-body">--}}
{{--                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <table class="table table-hover" id="productTable" style="width: 100%">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Category</th>--}}
{{--                                    <th scope="col">Name</th>--}}
{{--                                    <th scope="col">Price</th>--}}
{{--                                    <th scope="col">Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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
                    // $('#productTable').DataTable({
                    //     data: products,
                    //     columns: [
                    //         // {data: 'id'},
                    //         {data: 'productCategory'},
                    //         {data: 'productName'},
                    //         {data: 'productPrice'},
                    //         {data: 'id', title: 'Action', wrap: true, render: function (item) {
                    //             return `<div class="btn-group"> <button type="button" value="${item}" class="btn btn-light add-cart" >
                    //                 <i class="bi bi-plus"></i>
                    //             </button></div>` } },
                    //     ]
                    // });
                    const content = document.getElementById('products')
                    let card = ''
                    for (const product of products) {
                        card += `
                            <div class="card col-11 col-md-5 col-xl-3 col-xxl-3 p-1 rounded-3">
                                <img src="{{asset('/makanan.jpg')}}" class"card-img-top rounded-top" alt="card-img">
                                <div class="card-body">
                                    <p class="card-text text-center pb-0 mb-0">${product.productName}</p>
                                    <span class="font-monospace d-flex justify-content-center" style="font-size:14px">(${product.productCategory})</span>
                                    <p class="card-text text-end fw-bold">Rp.${product.productPrice}</p>
                                    <div class="input-group mb-3 w-50 mx-auto">
                                        <button type="button" class="btn btn-light border d-flex ms-auto minus-product ps-1 pe-1" value="${product.id}">
                                            <i class="bi bi-dash fs-5"></i>
                                        </button>
                                        <input type="text" class="form-control text-center" placeholder="" value="0">
                                        <button type="button" class="btn btn-light border d-flex ms-auto add-product ps-1 pe-1" value="${product.id}">
                                            <i class="bi bi-plus fs-5"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        `
                    }
                    content.innerHTML = card
                    $('#products').on('click', '.add-product', function() {
                        const value = $(this).val();
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
            url: '/api/cart',
            method: 'GET',
            data: {
                productId: btnValue || 0,
                quantity: 1
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
                $('#total-item').html(data.total)
            },
            error: function (data){

            }
        })
    }

</script>
</html>
