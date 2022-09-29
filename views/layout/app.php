<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <title><?= $title ?? 'Kamu Framework' ?></title>

    <!-- SEO -->
    <meta name="robots" content="index, follow, noodp" />
    <meta name="description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?" />
    <meta name="keywords" content="dikitlink, dikit.my.id, dikit, pemendek-url, pemendek, url" />
    <meta property="og:title" content="Dikit Link">
    <meta property="og:description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= asset('/') ?>">

    <!-- PWA -->
    <meta name="theme-color" content="#fff" />
    <link rel="manifest" href="<?= asset('manifest.webmanifest') ?>">
    <link rel="apple-touch-icon" href="<?= asset('icon-192x192.png') ?>">
    <link rel="icon" type="image/png" href="<?= asset('icon-192x192.png') ?>">

    <!-- Cache -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net/" crossorigin="anonymous" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" as="style" integrity="sha256-KTPJY0ik6ufLv48oDKCYFYaptcCX75UrmWytfSjy+tA=" crossorigin="anonymous" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" as="script" integrity="sha256-qFsv4wd3fI60fwah7sOZ/L3f6D0lL9IC0+E1gFH88n0=" crossorigin="anonymous" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/all.min.css" as="style" integrity="sha256-AbA177XfpSnFEvgpYu1jMygiLabzPCJCRIBtR5jGc0k=" crossorigin="anonymous" />
    <?= content('preload.home') ?>

    <!-- Style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" integrity="sha256-KTPJY0ik6ufLv48oDKCYFYaptcCX75UrmWytfSjy+tA=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/all.min.css" integrity="sha256-AbA177XfpSnFEvgpYu1jMygiLabzPCJCRIBtR5jGc0k=" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">

    <!-- Service Worker -->
    <script src="<?= asset('sw.js') ?>"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register('sw.js').then((reg) => {
                console.info('Service worker has been registered for scope: ' + reg.scope);
            });
        }
    </script>
    <?= content('utiltop') ?>
</head>

<body>
    <?= content('main') ?>

    <?= content('utildown') ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha256-qFsv4wd3fI60fwah7sOZ/L3f6D0lL9IC0+E1gFH88n0=" crossorigin="anonymous"></script>
</body>

</html>