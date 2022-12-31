<!DOCTYPE html>
<html lang="id" data-bs-theme="<?= session()->get('dark') ? 'dark' : 'light' ?>">

<head>
    <!-- Common -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <title><?= $title . ' - Link tuh dikit' ?></title>

    <!-- SEO -->
    <meta name="robots" content="index, follow">
    <meta name="title" content="<?= $title . ' - Link tuh dikit' ?>">
    <meta name="description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?">
    <meta name="keywords" content="dikitlink, dikit.my.id, dikit, pemendek-url, pemendek, shortenlink, linktuhdikit">
    <meta name="author" content="dewanakl">
    <meta name="google-site-verification" content="Z6IeT2dBLq3zI_KsN5F42gvyqycrI5JuqG7dtQoVnw0">
    <meta property="og:title" content="<?= $title . ' - Link tuh dikit' ?>">
    <meta property="og:keywords" content="dikitlink, dikit.my.id, dikit, pemendek-url, pemendek, shortenlink, linktuhdikit">
    <meta property="og:description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?">
    <meta property="og:image" content="<?= asset('icon-512x512.png') ?>">
    <meta property="og:image:alt" content="<?= asset('/') ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="dikit">
    <meta property="og:url" content="<?= asset('/') ?>">
    <meta property="twitter:title" content="<?= $title . ' - Link tuh dikit' ?>">
    <meta property="twitter:description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:image" content="<?= asset('icon-512x512.png') ?>">
    <meta property="twitter:url" content="<?= asset('/') ?>">

    <!-- PWA -->
    <meta name="theme-color" content="#<?= session()->get('dark') ? '28242c' : 'ffffff' ?>">
    <meta name="color-scheme" content="<?= session()->get('dark') ? 'dark' : 'light' ?>">
    <link rel="manifest" href="<?= asset('manifest.webmanifest') ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?= asset('icon-192x192.png') ?>">
    <link rel="icon" type="image/png" href="<?= asset('icon-192x192.png') ?>">
    <link rel="canonical" href="<?= asset('/') ?>">

    <!-- Cache -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link rel="preload" href="<?= asset('css/app.css') ?>" as="style">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" as="style" crossorigin="anonymous">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" as="script" crossorigin="anonymous">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/all.min.css" integrity="sha256-Z1K5uhUaJXA7Ll0XrZ/0JhX4lAtZFpT6jkKrEDT0drU=" as="style" crossorigin="anonymous">
    <?= content('preload.alert') ?>
    <?= content('preload.chart') ?>
    <?= content('preload.alert.dark') ?>

    <!-- Style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/all.min.css" integrity="sha256-Z1K5uhUaJXA7Ll0XrZ/0JhX4lAtZFpT6jkKrEDT0drU=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito&display=swap">
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">

    <!-- Service & Util -->
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register('sw.js')
                .then((reg) => console.info(`Service worker has been registered for scope: ${reg.scope}`))
                .catch((err) => console.error(`Registration failed with ${err}`));
        }
    </script>
    <?= content('utiltop') ?>
</head>

<body>
    <?= content('main') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
