<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }
        body{
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background: url('bg.png');
            background-size: cover;
        }
        .container{
            width: 100%;
            max-width: 650px;
            background: rgba(0,0,0,0.5);
            padding: 28px;
            margin: 0 28px;
            border-radius: 10px;
            box-shadow: inset -2px 2px 2px white;
        }
        .form-title{
            font-size: 26px;
            font-weight: 600;
            text-align: center;
            padding-bottom: 6px;
            color: white;
            text-shadow: 2px 2px 2px black;
            border-bottom: solid 1px white;

        }
        .main-user-info{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px 0;
        }
        .user-input-box{
            display: flex;
            flex-wrap: wrap;
            width: 50%;
            padding-bottom: 15px;
        }
        .user-input-box label{
            width: 95%;
            color: white;
            font-size: 20px;
            margin: 5px 0;
        }
        .user-input-box input{
            height: 40px;
            width: 95%;
            border-radius: 7px;
            outline: none;
            border: 1px solid grey;
            padding: 0 10px;
        }
        .form-submit-btn input{
            cursor: pointer;
        }
        .form-submit-btn{
            margin-top: 40px;
        }
        .form-submit-btn input{
            display: block;
            width: 100%;
            margin-top: 10px;
            font-size: 20px;
            padding: 10px;
            border: none;
            border-radius: 3px;
            color: black;
            background:#950101 ;
        }
        .form-submit-btn input:hover{
            background: #3D0000;
            color: black;
        }
        @media(max-width: 600px){
            .container{
                min-width: 280px;
            }
            .user-input-box{
                margin-bottom: 20px;
                width: 100%;
            }
            .user-input-box:nth-child(2n){
                justify-content: space-between;
            }
            .main-user-info{
                max-height: 380px;
                overflow: auto;
            }
            .main-user-info::-webkit-scrollbar{
                width: 0;
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>
<body>
<div class="container">
    <h1 class="form-title">Customer Forms</h1>
{{--    <form action="/api/reservation" method="post">--}}
        @csrf
        <div class="main-user-info">
            <div class="user-input-box">
                <label for="">Nama Customer</label>
                <input type="text" class="form-control" id="customerName" name="customerName" placeholder="name" autocomplete="off">
            </div>
            <div class="user-input-box">
                <label for="">Nomor Telepon</label>
                <input type="text" class="form-control" id="customerPhone" name="customerPhone" placeholder="phone" autocomplete="off">
            </div>
        </div>
        <div class="form-submit-btn">
            <input type="button" value="Order Sekarang" id="orderBtn">
        </div>
{{--    </form>--}}
</div>
<script>

    $('#orderBtn').click(function (){
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
                const token = data.token.original.access_token
                document.cookie = "SI-CAFE=" + token + ";path:/";
                window.location.href = '/api/order/product'
            }
        })
    });


</script>
</body>
</html>
