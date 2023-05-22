<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cashier Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/styledashboard.css') }}">

</head>
<body>
<div>
    <button class="btn " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Add Product
    </button>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="{{route('cashier.addProduct')}}" method="post">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <label for="staticEmail" class="col-sm-5 col-form-label">Product Name</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="text" id="productName" name="productName">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="staticEmail" class="col-sm-5 col-form-label">Product Category</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="productCategory" id="productCategory">
                                    <option>Chose One</option>
                                    <option value="Food">Food</option>
                                    <option value="Beverage">Beverage</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="product-price" class="col-sm-5 col-form-label">Price</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="number" id="productPrice" name="productPrice" min="1000" max="1000000">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="staticEmail" class="col-sm-5 col-form-label">Stock</label>
                            <div class="col-sm-5">
                                <input type="number" value="1" min="1" max="100" name="productStock" id="productStock" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="product">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Stock</th>
                <th scope="col">Price</th>
                <th scope="col">Delete</th>
                <th scope="col">Update</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <!-- trigger modal -->
                <tr data-bs-toggle="modal">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->productName }}</td>
                    <td>{{ $product->productCategory }}</td>
                    <td>{{ $product->productStock }}</td>
                    <td>{{ $product->productPrice }}</td>
                    <td>
                        <form action="{{route('cashier.deleteProduct', ['id'=>$product->id])}}" method="post">
                            @csrf
                            <button type="sumbit" name="deleteProduct" style="border: none; background-color: #EED6C4;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button>
                        </form>

                    </td>
                    <!-- Button trigger modal -->
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$product->id}}">
                            Update
                        </button>
                    </td>

                    <div class="modal fade" id="staticBackdrop-{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <form action="{{route('cashier.updateProduct', ['id'=>$product->id])}}" method="post">
                            @csrf
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Product</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <label for="staticEmail" class="col-sm-5 col-form-label">Product Price</label>
                                            <div class="col-sm-5">
                                                <input type="number" value="{{ $product->productPrice }}" name="productPrice" id="productPrice">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="staticEmail" class="col-sm-5 col-form-label">Product Stock</label>
                                            <div class="col-sm-5">
                                                <input type="number" value="{{ $product->productStock }}" min="1" max="100" name="productStock" id="productStock">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
</div>
</body>
</html>
