@extends('layouts.customer')

@section('content')
    <div class="container-xxl py-5" id="info">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Order</h5>
                <p>
                    <img src="/assets/img/check.gif" alt="check-icon" height="100px"  data-wow-delay="0.1s">
                </p>
                <h5 class="text-success fw-bold">Order Berhasil</h5>
                <h6>Kode pemesanan anda <span id="paymentCode"></span></h6>
                <p class="mb-5 fst-italic" id="message"></p>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function (){
            const segment = window.location.pathname.split('/')
            window.location.href = document.URL + '#info'
            $.ajax({
                'method': 'GET',
                'url': '/api/payment/'+segment[4],
                success: function (data){
                    $('#message').html(data.message);
                    $('#paymentCode').html(data.paymentCode)
                },
                error: function (data){
                    window.location.href = '/dinein/registration';
                }
            })
        })
    </script>
@endpush
