<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Cashier Login</title>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        #inp
        {
            color: white;
        }
        #lab
        {
            color: #FEA116;
        }
        body
        {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }

        /*------------ Login container ------------*/

        .box-area{
            width: 930px;
        }

        /*------------ Right box ------------*/

        .right-box{
            padding: 40px 30px 40px 40px;
        }

        /*------------ Custom Placeholder ------------*/

        ::placeholder{
            font-size: 16px;
        }

        .rounded-4{
            border-radius: 20px;
        }
        .rounded-5{
            border-radius: 30px;
        }


        /*------------ For small screens------------*/

        @media only screen and (max-width: 768px){

            .box-area{
                margin: 0 10px;

            }
            .left-box{
                height: 100px;
                overflow: hidden;
            }
            .right-box{
                padding: 20px;
            }

        }
    </style>
</head>
<body>

<!----------------------- Main Container -------------------------->

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!----------------------- Login Container -------------------------->

    <div class="row border rounded-5 p-3 shadow box-area" style="background-color: #151F28">

        <!--------------------------- Left Box ----------------------------->

        {{--        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="">--}}
        {{--            <img src="/assets/img/logoBg.png" class="img-fluid" style="width: 250px;">--}}
        {{--        </div>--}}

        <!-------------------- ------ Right Box ---------------------------->
        <div class="row align-items-center">
            <div class="header-text mb-4">
                <h2 style="color:#FEA116">Detail Transaction</h2>
            </div>
            <div class="dinein mx-4" id="transaction">

            </div>


            <div class="detaildinein">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" id="lab">Name</th>
                        <th scope="col" id="lab">Quantity</th>
                        <th scope="col" id="lab">Quantity Price</th>
                    </tr>
                    </thead>
                    <tbody id="detail">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $.ajax({
            url: '/api/transactions/' + {{$idDetailtransaction}},
            method: 'GET',
            header: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            success: function (data){
                const trx = data.transaction;
                const content = document.getElementById('transaction')
                let dataTrx =
                    `
            <div class="input-group mb-3">
                <label class="col-sm-5 col-form-label"  id="lab" >Id</label>
                    <div class="col-sm-5" >
                        <input type="number" id="inp" readonly class="form-control-plaintext" value="${ trx.id }">
                    </div>
            </div>
            <div class="input-group mb-3">
                <label class="col-sm-5 col-form-label" id="lab">Date</label>
                    <div class="col-sm-5">
                        <input type="text" id="inp" readonly class="form-control-plaintext" value="${ trx.transactionDate }">
                    </div>
            </div>
            <div class="input-group mb-3">
                <label class="col-sm-5 col-form-label" id="lab">Customer</label>
                    <div class="col-sm-5">
                        <input type="text" id="inp" readonly class="form-control-plaintext" value=" ${ trx.customerName  }" class="form-control">
                    </div>
            </div>
            <div class="input-group mb-3">
                <label class="col-sm-5 col-form-label" id="lab">Sub Total</label>
                    <div class="col-sm-5">
                        <input type="text" id="inp" readonly class="form-control-plaintext" value=" ${ trx.subtotalView  }" class="form-control">
                    </div>
            </div>
            <div class="input-group mb-3">
                <label class="col-sm-5 col-form-label" id="lab">Tax 10%</label>
                    <div class="col-sm-5">
                        <input type="text" id="inp" readonly class="form-control-plaintext" value=" ${trx.taxView }" class="form-control">
                    </div>
            </div>
<div class="input-group mb-3">
            <label class="col-sm-5 col-form-label" id="lab">Total Price</label>
                    <div class="col-sm-5">
                        <input type="text" id="inp" readonly class="form-control-plaintext" value=" ${ trx.priceView }" class="form-control">
                    </div>
            </div>
<div class="input-group mb-3">
                <label class="col-sm-5 col-form-label" id="lab">Status</label>
                    <div class="col-sm-5">
                        <input type="text" id="inp" readonly class="form-control-plaintext" value=" ${ trx.status }" class="form-control">
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
                        <td  id="inp">${det.productName}</td>
                        <td  id="inp">${det.quantity}</td>
                        <td  id="inp">${det.priceView}</td>
                    </tr>
                    `
                }
                content2.innerHTML = dataDetail
            }
        })
    });

</script>
</body>
</html>
