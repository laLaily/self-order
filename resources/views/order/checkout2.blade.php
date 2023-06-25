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
    </div>
</nav>

<div class="container pt-4" >
    <div class="card">
        <div class="card-content p-3">
            <table id="order" class="table table-responsive" style="width: 100%">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-success rounded-pill mt-3" id="checkout" type="button">
            Place Order
            <span><i class="bi bi-check-circle"></i></span>
        </button>
    </div>
</div>
</body>

<footer class="p-3 text-center">
    &copy; 2021
</footer>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>

    $(document).ready(function(){
        let table;
        let detail;
        const segment = window.location.pathname.split('/')
        console.info(segment[2])
        $('#checkout').attr('action', '/checkout/'+segment[2])
        $.ajax({
            type: 'GET',
            url: '/api/checkout/' + segment[2],
            success: function (data) {
                detail = data.detail
                table =  $('#order').DataTable({
                    data: detail.detail,
                    ordering: false,
                    columns: [
                        {data: null, title: 'Image',
                            render: function(item){
                                return "<img src='/../makanan.jpg' height='100' alt='gambar'/>"
                            },
                        },
                        {data: 'products.productName'},
                        // {data: 'quantityPrice'},
                        {data: 'quantity'},
                        {data: 'quantityPrice'},
                    ],
                    paging:   false,
                    bFilter: false,
                })
            }
        }).then(function(){
            $('#order tbody').append("<tr><td></td><td></td><td><b>Subtotal<b></td><td><b>" + detail.subtotal + "<b></td></tr>")

            $('#order tbody').append("<tr><td></td><td></td><td><b>Tax<b></td><td><b>" + detail.tax + "<b></td></tr>")

            $('#order tbody').append("<tr><td></td><td></td><td><b>Total<b></td><td><b>" + detail.totalPrice + "<b></td></tr>")
        })

        $('#checkout').on('click', function (event) {
            $.ajax({
                method: 'POST',
                url: "/api/checkout/" + segment[2],
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                success: function (data){
                    window.location.href = '/dinein/order/success/' + segment[2]
                }
            })
        })
    })
</script>
</html>
