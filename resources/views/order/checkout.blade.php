@extends('layouts.customer')

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">All Order</h5>
            </div>
            <div class="row g-4">
                <div class="col-lg-12 col-sm-12 wow fadeInUp" >
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
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success rounded-pill mt-3" id="checkout" type="button">
                            Order
                            <span><i class="bi bi-check-circle"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
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
                                    return "<img src='/assets/img/menu-1.jpg' height='100' alt='gambar'/>"
                                },
                            },
                            {data: 'products.productName'},
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
                    },
                    error: function (){
                        window.location.href = '/dinein/registration'
                    }
                })
            })
        })
    </script>
@endpush

