<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Cashier Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body
        {
            font-family: 'Poppins', sans-serif;
            background: white;
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

        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="">
            <img src="/assets/img/logoBg.png" class="img-fluid" style="width: 250px;">
{{--            <div class="featured-image mb-3">--}}
{{--                --}}
{{--            </div>--}}
{{--            <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>--}}
{{--            <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on this platform.</small>--}}
        </div>

        <!-------------------- ------ Right Box ---------------------------->

        <div class="col-md-6 right-box login">
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2 style="color:#FEA116">Hello, Cashier</h2>

                </div>
                <div class="input-group mb-3">
                    <input type="text" name="username" id="username" class="form-control form-control-lg bg-light fs-6" placeholder="Username">
                </div>
                <div class="input-group mb-1">
                    <input type="password" id="pass" type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                </div>
                <div class="input-group mb-3">
                    <button id="orderBtn" class="btn btn-lg btn-light w-100 fs-6"><small>Login</small></button>
                </div>

            </div>
        </div>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
    $('#orderBtn').click(function (){
        $.ajax({
            url: '/api/login',
            method: 'POST',
            header: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            data: {
                'username': $('#username').val(),
                'pass': $('#pass').val()
            },
            success: function (){
                window.location.href = "/cashier/dashboard";
            },

        })
    });
</script>
</body>
</html>
