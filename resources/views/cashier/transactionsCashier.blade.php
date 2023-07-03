<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cashier Transactions</title>

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

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
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
    <table class="table" >
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
    </table>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '/api/transactions',
            success: function (data){
                const transactions = data.transactions
                const content = document.getElementById('transactions')
                let table = ''
                for (const trx of transactions) {
                    table += `
                    <tr style="cursor: default;">
                    <td>${ trx.id }</td>
                    <td>${ trx.transactionDate }</td>
                    <td>${ trx.customerName }</td>
                    <td>${ trx.priceView }</td>
                    <td>${ trx.status }</td>
                    <td>${ trx.updatedAt }</td>
                    <td>
                        <button type="submit" class="btn btn-view"  value="${ trx.id }" id="btnView">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                        </button>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-update" id="success" name="success" value="${ trx.id }">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                            </svg>
                        </button>

                    </td>
                    </tr>
                    `
                }
                content.innerHTML = table
                // $('#transactions').on('click', '.btn-view', function() {
                //     const value = $(this).val();
                //     console.log(value)
                //     window.location.href = "/cashier/transaction/view/" + value;
                // });
                $('#transactions').on('click', '.btn-update', function() {
                    const value = $(this).val();
                    console.log(value)
                    updateStatus(value)
                });
            }
        })

    });
        function updateStatus(idTrx) {
            $.ajax({
                url: '/api/transscation/' + idTrx,
                method: 'PUT',
                data: {
                    productId: idTrx
                },
                success: function (data) {
                    window.location.href = "/cashier/transaction/view";
                },
                error: function (data) {

                }
            })
        }

</script>
</body>
</html>
