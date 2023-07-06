<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="{{ mix('css/templateHeader.css') }}">
    <link rel="stylesheet" href="{{ mix('css/templateFooter.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/styledashboard.css') }}">

    <title>Document</title>
</head>
<body>
<nav class="navbar sticky-top" style="background-color: #efefef">
    <div class="container">
        <a class="navbar-brand" href="/cashier/dashboard">
            <img src="{{asset('/logo.jpg')}}" alt="Logo" width="40" class="d-inline-block align-text-center p-0">
            Flower Cafe
        </a>
        <div class="navbar-nav pe-3">
            <a type="button" class="btn position-relative border border-dark btn-light" href="/cashier/transaction/view">
                View Transaction
            </a>
        </div>
    </div>

</nav>

<div class="dinein mx-4" id="transaction">

</div>


<div class="detaildinein">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Quantity Price</th>
        </tr>
        </thead>
        <tbody id="detail">

        </tbody>
    </table>
</div>


<script>
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '/api/transactions/' + {{$idDetailtransaction}},
            success: function (data){
                const trx = data.transaction;
                const content = document.getElementById('transaction')
                let dataTrx = ''
                    dataTrx = `
                <div class="row">
                    <label class="col-sm-5 col-form-label">Id</label>
                    <div class="col-sm-5">
                        <input type="number" readonly class="form-control-plaintext" value="${ trx.id }">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Date</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value="${ trx.transactionDate }">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Customer</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" ${ trx.customerName  }" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Sub Total</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" ${ trx.subtotalView  }" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Tax 10%</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" ${trx.taxView }" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Total Price</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" ${ trx.priceView }" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Status</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" ${ trx.status }" class="form-control">
                    </div>
                </div>
                `
                content.innerHTML = dataTrx

                const detail = data.detail;
                const content2 = document.getElementById('detail')
                let dataDetail = ''
                for(const det of detail) {
                    dataDetail +=
                    `
                    <tr>
                        <td>${det.productName}</td>
                        <td>${det.quantity}</td>
                        <td>${det.priceView}</td>
                    </tr>
                    `
                }
                content2.innerHTML = dataDetail
            },
        })
    }
    );
</script>
</body>
</html>
