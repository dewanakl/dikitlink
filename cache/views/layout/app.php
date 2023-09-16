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
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="title" content="<?= $title . ' - Link tuh dikit' ?>">
    <meta name="description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail. Cobain dehhh, seriuss !!!">
    <meta name="keywords" content="dikitlink, dikit.my.id, dikit, sedikit, pendek, link shortener, url, url link, pemendek url, pemendek, shortenlink, linktuhdikit, link dikit, link pendek, url dikit, url pendek">
    <meta name="author" content="dewanakl">
    <meta name="google-site-verification" content="Z6IeT2dBLq3zI_KsN5F42gvyqycrI5JuqG7dtQoVnw0">
    <meta property="og:title" content="<?= $title . ' - Link tuh dikit' ?>">
    <meta property="og:keywords" content="dikitlink, dikit.my.id, dikit, sedikit, pendek, link shortener, url, url link, pemendek url, pemendek, shortenlink, linktuhdikit, link dikit, link pendek, url dikit, url pendek">
    <meta property="og:description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail. Cobain dehhh, seriuss !!!">
    <meta property="og:image" content="<?= asset('icon-512x512.png') ?>">
    <meta property="og:image:alt" content="<?= asset('/') ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Dikit Link">
    <meta property="og:url" content="<?= asset('/') ?>">
    <meta property="twitter:title" content="<?= $title . ' - Link tuh dikit' ?>">
    <meta property="twitter:description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail. Cobain dehhh, seriuss !!!">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:image" content="<?= asset('icon-512x512.png') ?>">
    <meta property="twitter:url" content="<?= asset('/') ?>">

    <!-- PWA -->
    <meta name="theme-color" content="#<?= session()->get('dark') ? '212529' : 'ffffff' ?>">
    <meta name="color-scheme" content="<?= session()->get('dark') ? 'dark' : 'light' ?>">
    <link rel="manifest" href="<?= asset('manifest.webmanifest') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= asset('favicon.ico') ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?= asset('icon-192x192.png') ?>">
    <link rel="icon" type="image/png" href="<?= asset('icon-192x192.png') ?>">
    <link rel="canonical" href="<?= asset('/') ?>">

    <!-- Cache -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://google.com" crossorigin>
    <link rel="preload" href="<?= asset('css/app.css') ?>" as="style">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css" integrity="sha256-WAgYcAck1C1/zEl5sBl5cfyhxtLgKGdpI3oKyJffVRI=" as="style" crossorigin="anonymous">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha256-MBffSnbbXwHCuZtgPYiwMQbfE7z+GOZ7fBPCNB06Z98=" as="style" crossorigin="anonymous">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha256-gvZPYrsDwbwYJLD5yeBfcNujPhRoGOY831wwbIzz3t0=" as="script" crossorigin="anonymous">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css" integrity="sha256-CTSx/A06dm1B063156EVh15m6Y67pAjZZaQc89LLSrU=" as="style" crossorigin="anonymous">
    <?= content('preload.alert') ?>
    <?= content('preload.chart') ?>
    <?= content('preload.alert.dark') ?>

    <!-- Style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css" integrity="sha256-WAgYcAck1C1/zEl5sBl5cfyhxtLgKGdpI3oKyJffVRI=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha256-MBffSnbbXwHCuZtgPYiwMQbfE7z+GOZ7fBPCNB06Z98=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css" integrity="sha256-CTSx/A06dm1B063156EVh15m6Y67pAjZZaQc89LLSrU=" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha256-gvZPYrsDwbwYJLD5yeBfcNujPhRoGOY831wwbIzz3t0=" crossorigin="anonymous"></script>
</body>

</html>