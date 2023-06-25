@extends('layouts.customer')

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                <h1 class="mb-5">All Menu</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">

                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4" id="products">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container position-fixed fixed-bottom text-end pb-3 ">
            <a type="button" class="btn p-0 m-0" href="#" id="checkout">
                <i class="bi bi-cart-fill text-info fs-1 position-relative">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border-1 bg-warning ps-2 pe-2 text-white fs-6" id="total-item">
                    0
                <span class="visually-hidden">Total Cart</span>
                </span>
                </i>
            </a>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: '/api/products',
                success: function (data){
                    const products = data.products
                    const content = document.getElementById('products')
                    let card = ''
                    for (const product of products) {
                        card += `
                            <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="/assets/img/menu-1.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>${product.productName}</span>
                                                <span class="text-primary">${product.productPrice}</span>
                                            </h5>
                                            <small class="d-flex fs-6 ms-auto">
                                                <button type="button" class=" btn-danger border rounded-circle edit-product" id="${product.id}"
                                                value="-1"><i class="bi bi-dash"></i></button>
                                                <input type="text" class="text-primary text-center border-0" value="${product.total??0}" id="inp-${product.id}" disabled style="width: 2rem">
                                                <button type="button" class=" btn-success border rounded-circle edit-product" id="${product.id}"
                                                value="1"><i class="bi bi-plus"></i>
                                                </button>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                        `
                    }
                    content.innerHTML = card
                    $('#products').on('click', '.edit-product', function() {
                        sendEvent(this)
                    });
                }
            })
            sendEvent(this)
        });


        async function getProduct(url){
            const response = await fetch(url);
            const json = await response.json()
            return await json;
        }

        function sendEvent(el){
            $.ajax({
                url: '/api/cart',
                method: 'GET',
                data: {
                    productId: el.id,
                    quantity: el.value,
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

                    if(data.transactionId){
                        $('#checkout').attr('href', '/checkout/' + data.transactionId)
                    }

                    const value = document.getElementById('inp-'+el.id)?.value ?? 0
                    if(value)
                        document.getElementById('inp-'+el.id).value = parseInt(value) + parseInt(el.value)

                    $('#total-item').html(data.total)
                },
                error: function (data){
                    console.info(data)
                    const response = JSON.parse(data.responseText)
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false
                    })
                }
            })
        }


    </script>
@endpush
