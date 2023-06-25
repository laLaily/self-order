<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Thank You For Order</p>
    <p id="message"></p>
    <p>Kode Pembayaran anda : <span id="paymentCode"></span></p>
    <p></p>
    <div class="card-body">

    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
    $(document).ready(function (){
        const segment = window.location.pathname.split('/')
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
</html>
