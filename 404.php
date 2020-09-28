<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Muli:400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?= asset('css/errors/css/style.css') ?>" />

    <style>
        #notfound .notfound-bg
        {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url(<?= asset('includes/bg.jpg') ?>);
            background-size: cover;
        }

    </style>
    <title>404 :: Page not found</title>

</head>
<body>
<div id="notfound">
    <div class="notfound-bg"></div>
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2>Oops! Page Not Found</h2>
        <a href="<?= asset() ?>">Back To Homepage</a>
    </div>
</div>
</body>
</html>