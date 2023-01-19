<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1 style="color: #126dff;"><?= ucfirst(env('APP_NAME')) ?></h1>

    <?= content('main') ?>

    <hr />
    <p>Salam hangat dari <?= env('APP_NAME') ?></p>
    <p><a href="<?= asset('/') ?>" style="color: #126dff;"><?= e(parse_url(baseurl(), PHP_URL_HOST)) ?></a></p>
</body>

</html>