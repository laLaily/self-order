@extends('layouts.customer')

@section('content')
    <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="video">
                    <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/watch?v=TT9wIWPlOYs" data-bs-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                    <h1 class="text-white mb-4">Get Your Order Here</h1>
                    <form action="/api/reservation" method="post" name="registration">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" placeholder="Your Name" id="customerName" autocomplete="off">
                                    <label for="customerName">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" placeholder="Your Phone" id="customerPhone" autocomplete="off">
                                    <label for="customerPhone">Your Phone</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit" id="orderBtn">Order Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#orderBtn').on('click', function (event){
            console.info($('#customerName').val())
            event.preventDefault()
            submit()
        });

        function submit(){
            $.ajax({
                url: '/api/reservation',
                method: 'POST',
                header: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                data: {
                    'customerName': $('#customerName').val(),
                    'customerPhone': $('#customerPhone').val()
                },
                success: function (data){
                    window.location.href = "/dinein/order/products";
                }
            })
        }
    </script>
@endpush

