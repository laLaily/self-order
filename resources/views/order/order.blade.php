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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" integrity="sha512-NXUhxhkDgZYOMjaIgd89zF2w51Mub53Ru3zCNp5LTlEzMbNNAjTjDbpURYGS5Mop2cU4b7re1nOIucsVlrx9fA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
</head>
<body>
    <div class="container h-100">
        <div class="row justify-content-center mt-5">
            <div class="col-10 ">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="">
                            <!-- Filter -->
                            <form action="/api/cart" method="get">
                                <label for="filter">Pilih Kategori</label>
                                <div class="d-flex gap-2">
                                    <select name="filter" id="filter" class="form-select w-50">
                                        <option selected value="">All</option>
                                        <option value="beverage">Beverage</option>
                                        <option value="food">Food</option>
                                    </select>
                                    <button type="submit" class="btn btn-light border">
                                        Pilih
                                    </button>
                                </div>
                            </form>
                            <!-- Button trigger modal -->
                            <div>
{{--                                @foreach($transactions as $transaction)--}}
{{--                                    <div class="btn-group" role="group" aria-label="Basic outlined example">--}}
{{--                                        <button type="button" class="btn btn-outline-dark" disabled>{{ $totalProduct }}/{{ $transaction->totalPriceView }}</button>--}}
{{--                                        <button type="button" class="btn button las la-shopping-bag" data-bs-toggle="modal" data-bs-target="#cart"></button>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
                            </div>
                        </div>

                        <!-- Cart -->
                        <!-- Modal -->

                        <div class="modal fade" id="cart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Cart</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
{{--                                            @foreach($transactions as $transaction)--}}
{{--                                                <div class="row">--}}
{{--                                                    <label for="customerName" class="col-sm-5 col-form-label">Name</label>--}}
{{--                                                    <div class="col-sm-5">--}}
{{--                                                        <input type="text" readonly class="form-control-plaintext" id="customerName" value="{{ $transaction->customerName }}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="row">--}}
{{--                                                    <label for="transactionDate" class="col-sm-5 col-form-label">Transaction Date</label>--}}
{{--                                                    <div class="col-sm-5">--}}
{{--                                                        <input type="text" readonly class="form-control-plaintext" id="transactionDate" value="{{ $transaction->transactionDate }}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="row">--}}
{{--                                                    <label for="subtotal" class="col-sm-5 col-form-label">Subtotal</label>--}}
{{--                                                    <div class="col-sm-5">--}}
{{--                                                        <input type="text" readonly class="form-control-plaintext" id="subtotal" value="{{ $transaction->subtotalView }}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="row">--}}
{{--                                                    <label for="tax" class="col-sm-5 col-form-label">Tax 10%</label>--}}
{{--                                                    <div class="col-sm-5">--}}
{{--                                                        <input type="text" readonly class="form-control-plaintext" id="tax" value="{{ $transaction->taxView }}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="row">--}}
{{--                                                    <label for="totalPrice" class="col-sm-5 col-form-label">Total Price</label>--}}
{{--                                                    <div class="col-sm-5">--}}
{{--                                                        <input type="text" readonly class="form-control-plaintext" id="totalPrice" value="{{ $transaction->totalPriceView }}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
                                        </div>
                                        <div>
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Quantity Price</th>
                                                    <th scope="col"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
{{--                                                @isset($carts)--}}
{{--                                                    @foreach ($carts as $cart)--}}
{{--                                                        <form action="/api/cart" method="POST">--}}
{{--                                                            @method('DELETE')--}}
{{--                                                            @csrf--}}
{{--                                                            <tr>--}}
{{--                                                                <td>{{ $cart->productName }}</td>--}}
{{--                                                                <td>{{ $cart->quantity }}</td>--}}
{{--                                                                <td>{{ $cart->priceView }}</td>--}}

{{--                                                                <input type="hidden" name="productId" id="productId" value="{{ $cart->productId }}">--}}

{{--                                                                <td>--}}
{{--                                                                    <button type="sumbit" name="deleteCart" style="border: none; background-color: white;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">--}}
{{--                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">--}}
{{--                                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />--}}
{{--                                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />--}}
{{--                                                                        </svg>--}}
{{--                                                                    </button>--}}
{{--                                                                </td>--}}
{{--                                                            </tr>--}}
{{--                                                        </form>--}}
{{--                                                    @endforeach--}}
{{--                                                @endisset--}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-secondary button">
                                            <a href="{{route("submitOrder")}}" class="link-light text-decoration-none ">Confim Order</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Daftar Menu -->
                        <div class="products" >
                            <table class="table table-hover" id="productTable" style="width: 100%">
                                <thead>
                                <tr>
{{--                                    <th scope="col">No</th>--}}
                                    <th scope="col">Category</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
{{--                                <tbody id="products">--}}
{{--                                @foreach ($products as $product)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $loop->iteration }}</td>--}}
{{--                                        <td>{{ $product->productCategory }}</td>--}}
{{--                                        <td>{{ $product->productName }}</td>--}}
{{--                                        <td>{{ $product->priceView }}</td>--}}
{{--                                        <td>--}}
{{--                                            <button type="button" class="btn btn-primary btn-sm btn-add" id="{{$product->id}}">--}}
{{--                                                +--}}
{{--                                            </button>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>

        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: '/api/products',
                success: function (data){
                    const products = data.products
                    console.info(products)
                    $('#productTable').DataTable({
                        data: products,
                        columns: [
                            // {data: 'id'},
                            {data: 'productCategory'},
                            {data: 'productName'},
                            {data: 'productPrice'},
                            { 'data': null, title: 'Action', wrap: true, "render": function (item) {
                                return '<div class="btn-group"> <button type="button" onclick="set_value(' + item.ID + ')" value="0" class="btn btn-warning" data-toggle="modal" data-target="#myModal">View</button></div>' } },
                        ]

                    });
                }
            })

            getProduct('/api/products')
                .then((data)=>console.info(data))
    });

    async function getProduct(url){
        const response = await fetch(url);
        const products = await response.json()
        return await products.products;
    }


    const btnAdd = document.querySelectorAll('.btn-add');

    btnAdd.forEach(item => {
        item.onclick = () => {
            $.ajax({
                url: '/api/cart',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                data: {
                    productId: item.id,
{{--                    transaction_id: {{$transaction->id}},--}}
                    quantity: 1
                },
                success: function (data){
                    new Noty({
                        theme: 'sunset',
                        type: 'success',
                        layout: 'bottom',
                        text: data.message,
                        timeout: 1000
                    }).show();
                },
                error: function (data){

                }
            })
        }
    })
</script>
</html>
