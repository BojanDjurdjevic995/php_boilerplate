<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="<?= asset('css/bootstrap-dtables-$confirm-awesome.min.css') ?>">

    <style>
        body {background-image: url("<?= asset('includes/login-bg.jpg') ?>")}
        .container
        {
            height: 98vh;
            align-items: center;
            justify-content: center;
            display: flex;
        }
        #login-wrapper
        {
            width: 24rem;
            padding: 10px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="login-wrapper">
            <form action="<?= route('login') ?>" method="post">
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text""><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" name="email" class="form-control <?= session('login_error') ? 'is-invalid' : '' ?> " placeholder="Username">
                        <div class="invalid-tooltip">
                            Email or password is incorect
                        </div>
                    </div>
                </div>

                <div class="mb-3 mt-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text""><i class="fa fa-user"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>

                <button class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    <script src="<?= asset('js/all-scripts.min.js') ?>"></script>
    <script>
        $(document).ready(function (){
            var session_exist = <?= session('login_error') ?>;
            if (session_exist)
                setTimeout(function (){$('input[name="email"]').removeClass('is-invalid')}, 5000)
        })
    </script>
</body>
</html>