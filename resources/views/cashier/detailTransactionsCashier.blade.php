<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/styledashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
{{--<div class="mx-4 mb-3 back">--}}
{{--    <a href="/cashier/transaction/view">--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">--}}
{{--            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />--}}
{{--        </svg>--}}
{{--    </a>--}}
{{--</div>--}}
<div class="dinein mx-4">
    @foreach ($trx as $d)
        <div class="row">
            <label class="col-sm-5 col-form-label">Id</label>
            <div class="col-sm-5">
                <input type="number" readonly class="form-control-plaintext" value="{{ $d->id }}">
            </div>
        </div>

        <div class="row">
            <label class="col-sm-5 col-form-label">Date</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" value="{{ $d->transactionDate }}">
            </div>
        </div>

        <div class="row">
            <label class="col-sm-5 col-form-label">Customer</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" value=" {{ $d->customerName  }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <label class="col-sm-5 col-form-label">Sub Total</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" value=" {{ $d->subtotalView  }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <label class="col-sm-5 col-form-label">Tax 10%</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" value=" {{ $d->taxView  }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <label class="col-sm-5 col-form-label">Total Price</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" value=" {{ $d->priceView  }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <label class="col-sm-5 col-form-label">Status</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" value=" {{ $d->status  }}" class="form-control">
            </div>
        </div>
    @endforeach
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
        <tbody>
        @isset($detail)
            @foreach ($detail as $dinein)
                <form>
                    <tr>
                        <td>{{ $dinein->productName }}</td>
                        <td>{{ $dinein->quantity }}</td>
                        <td>{{ $dinein->priceView }}</td>
                    </tr>
                </form>
            @endforeach


        </tbody>
        </td>
    </table>
</div>
@endisset
</body>
</html>
