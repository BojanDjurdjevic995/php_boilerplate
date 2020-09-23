<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BAKI</title>
</head>
<body>
    <form action="<?= route('baki') ?>" method="POST">
        <input type="text" name="name">
        <input type="text" name="surname">
        <button>Save</button>
    </form>

    <a href="<?= route('news.show', ['id' => 1]) ?>">Novost</a>
</body>
</html>