<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cashier Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/styledashboard.css') }}">

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
<br>
<div class="transaction">
    <table class="table" id="transactions">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Date</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Total Price</th>
            <th scope="col">Status</th>
            <th scope="col">Updated at</th>
            <th scope="col">Detail</th>
            <th scope="col">Update Status</th>
        </tr>
        </thead>
        <tbody id="transactions">

        </tbody>
{{--        <tbody>--}}
{{--        @foreach ($transactions as $dinein)--}}
{{--            <tr style="cursor: default;">--}}
{{--                <td>{{ $dinein->id }}</td>--}}
{{--                <td>{{ $dinein->transactionDate }}</td>--}}
{{--                <td>{{ $dinein->customerName }}</td>--}}
{{--                <td>{{ $dinein->priceView }}</td>--}}
{{--                <td>{{ $dinein->status }}</td>--}}
{{--                <td>{{ $dinein->updatedAt }}</td>--}}
{{--                <td><a href="{{route('cashier.viewDetailTransaction', ['id'=>$dinein->id])}}" class="btn">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">--}}
{{--                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />--}}
{{--                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />--}}
{{--                        </svg>--}}
{{--                    </a></td>--}}
{{--                <td>--}}
{{--                    <form action="{{route('cashier.updateStatus', ['id'=>$dinein->id])}}" method="post">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn" id="success" name="success" value="Success">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">--}}
{{--                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />--}}
{{--                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />--}}
{{--                            </svg>--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
    </table>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '/api/transctions',
            success: function (data){
                const transactions = data.transactions
                const content = document.getElementById('transactions')
                let table = ''
                for (const trx of transactions) {
                    table += `
                    <tr style="cursor: default;">
                    <td>${trx.id}</td>
                    <td>${trx.transactionDate }</td>
                    <td>${ trx.customerName}</td>
                                    <td>${ trx.priceView}</td>
                                    <td>${ trx.status }</td>
                                    <td>${ trx.updatedAt }</td>
                                    <td><a href="" class="btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </a></td>
                                    <td>
                                        <form action="" method="post">
                                            @csrf
                                            <button type="submit" class="btn" id="success" name="success" value="Success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                    `
                    {{--table += `--}}
                    {{--        <div class="card col-11 col-md-5 col-xl-3 col-xxl-3 p-1 rounded-3">--}}
                    {{--            <img src="{{asset('/makanan.jpg')}}" class"card-img-top rounded-top" alt="card-img">--}}
                    {{--            <div class="card-body">--}}
                    {{--                <p class="card-text text-center pb-0 mb-0">${product.productName}</p>--}}
                    {{--                <span class="font-monospace d-flex justify-content-center" style="font-size:14px">(${product.productCategory})</span>--}}
                    {{--                <p class="card-text text-end fw-bold">Rp.${product.productPrice}</p>--}}
                    {{--                <div class="input-group mb-3 w-50 mx-auto">--}}
                    {{--                    <button type="button" class="btn btn-light border d-flex ms-auto minus-product ps-1 pe-1" value="${product.id}">--}}
                    {{--                        <i class="bi bi-dash fs-5"></i>--}}
                    {{--                    </button>--}}
                    {{--                    <input type="text" class="form-control text-center" placeholder="" value="0">--}}
                    {{--                    <button type="button" class="btn btn-light border d-flex ms-auto add-product ps-1 pe-1" value="${product.id}">--}}
                    {{--                        <i class="bi bi-plus fs-5"></i>--}}
                    {{--                    </button>--}}
                    {{--                </div>--}}

                    {{--            </div>--}}
                    {{--        </div>--}}
                    {{--    `--}}
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
</script>
</body>
</html>
