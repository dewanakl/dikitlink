<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="index, follow, noodp" name="robots" />
    <meta content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?" name="description" />
    <meta content="dikitlink, dikit.my.id, dikit, pemendek-url, pemendek, url" name="keywords" />
    <meta property="og:title" content="Dikit Link">
    <meta property="og:description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= asset('/') ?>">
    <meta name="theme-color" content="#fff" />
    <title><?= $title ?? 'Kamu Framework' ?></title>
    <link rel="manifest" href="<?= asset('manifest.webmanifest') ?>">
    <link rel="apple-touch-icon" href="<?= asset('icon-192x192.png') ?>">
    <link rel="icon" type="image/png" href="<?= asset('icon-192x192.png') ?>">
    <link rel="preconnect" href="<?= asset('/') ?>" />
    <link rel="preconnect" href="https://cdn.jsdelivr.net/" crossorigin="anonymous" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" as="style" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous" as="script" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/all.min.css" integrity="sha256-AbA177XfpSnFEvgpYu1jMygiLabzPCJCRIBtR5jGc0k=" crossorigin="anonymous" as="style" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/all.min.css" integrity="sha256-AbA177XfpSnFEvgpYu1jMygiLabzPCJCRIBtR5jGc0k=" crossorigin="anonymous">
    <link rel="preload" href="<?= asset('css/app.css') ?>" as="style">
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
    <script src="<?= asset('sw.js') ?>"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register('sw.js').then((reg) => {
                console.log('Service worker has been registered for scope: ' + reg.scope);
            });
        }
    </script>
</head>

<body>