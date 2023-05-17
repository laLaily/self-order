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

</head>
<body>
<div>
    <!-- Filter -->
    <form action="{{route("filterProduct")}}" method="post">
        @csrf
        <select name="filter" id="filter">
            <option selected value="">All</option>
            <option value="beverage">Beverage</option>
            <option value="food">Food</option>
        </select>
        <button type="submit">
            Do
        </button>
    </form>
    <!-- Button trigger modal -->
    <div>
        @foreach($transactions as $transaction)
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-dark" disabled>{{ $totalProduct }}/{{ $transaction->totalPriceView }}</button>
                <button type="button" class="btn button las la-shopping-bag" data-bs-toggle="modal" data-bs-target="#cart"></button>
            </div>
        @endforeach
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
                    @foreach($transactions as $transaction)
                        <div class="row">
                            <label for="customerName" class="col-sm-5 col-form-label">Name</label>
                            <div class="col-sm-5">
                                <input type="text" readonly class="form-control-plaintext" id="customerName" value="{{ $transaction->customerName }}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="transactionDate" class="col-sm-5 col-form-label">Transaction Date</label>
                            <div class="col-sm-5">
                                <input type="text" readonly class="form-control-plaintext" id="transactionDate" value="{{ $transaction->transactionDate }}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="subtotal" class="col-sm-5 col-form-label">Subtotal</label>
                            <div class="col-sm-5">
                                <input type="text" readonly class="form-control-plaintext" id="subtotal" value="{{ $transaction->subtotalView }}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="tax" class="col-sm-5 col-form-label">Tax 10%</label>
                            <div class="col-sm-5">
                                <input type="text" readonly class="form-control-plaintext" id="tax" value="{{ $transaction->taxView }}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="totalPrice" class="col-sm-5 col-form-label">Total Price</label>
                            <div class="col-sm-5">
                                <input type="text" readonly class="form-control-plaintext" id="totalPrice" value="{{ $transaction->totalPriceView }}">
                            </div>
                        </div>
                    @endforeach
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
                        @isset($carts)
                            @foreach ($carts as $cart)
                                <form action="{{route("deleteProduct")}}" method="post">
                                    @csrf
                                    <tr>
                                        <td>{{ $cart->productName }}</td>
                                        <td>{{ $cart->quantity }}</td>
                                        <td>{{ $cart->priceView }}</td>

                                        <input type="hidden" name="productId" id="productId" value="{{ $cart->productId }}">

                                        <td>
                                            <button type="sumbit" name="deleteCart" style="border: none; background-color: white;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn button">
                    <a href="{{route("submitOrder")}}" class="link-light text-decoration-none">Confim Order</a>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Daftar Menu -->
<div class="products">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Category</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <!-- trigger modal -->
            <tr data-bs-toggle="modal" data-bs-target="#staticBackdrop-all-{{$product->id}}" style="cursor: pointer;">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->productCategory }}</td>
                <td>{{ $product->productName }}</td>
                <td>{{ $product->priceView }}</td>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop-all-{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <form action="{{route("addTrxProduct")}}" method="post">
                        @csrf
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Order Quantity</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <label for="staticEmail" class="col-sm-5 col-form-label">Product Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $product->productName }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="staticEmail" class="col-sm-5 col-form-label">Quantity</label>
                                        <div class="col-sm-5">
                                            <input type="number" value="1" min="1" max="100" name="quantity" id="quantity" class="form-control">
                                        </div>
                                    </div>
                                    <input type="hidden" name="productId" id="productId" value="{{ $product->id }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn button">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
