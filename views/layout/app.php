<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <title><?= $title ?? 'Dikit Link' ?></title>

    <!-- SEO -->
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?" />
    <meta name="keywords" content="dikitlink, dikit.my.id, dikit, pemendek-url, pemendek, url" />
    <meta name="author" content="dewanakl" />
    <meta property="og:title" content="Dikit Link" />
    <meta property="og:keywords" content="dikitlink, dikit.my.id, dikit, pemendek-url, pemendek, url" />
    <meta property="og:description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?" />
    <meta property="og:image" content="<?= asset('icon-512x512.png') ?>" />
    <meta property="og:image:alt" content="<?= asset('/') ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:site_name" content="dikit" />
    <meta property="og:url" content="<?= asset('/') ?>" />
    <meta name="twitter:title" content="Dikit Link" />
    <meta name="twitter:description" content="Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?" />
    <meta name="twitter:image" content="<?= asset('icon-512x512.png') ?>" />
    <meta name="twitter:site" content="<?= asset('/') ?>" />

    <!-- PWA -->
    <meta name="theme-color" content="#fff" />
    <link rel="manifest" href="<?= asset('manifest.webmanifest') ?>">
    <link rel="apple-touch-icon" href="<?= asset('icon-192x192.png') ?>">
    <link rel="icon" type="image/png" href="<?= asset('icon-192x192.png') ?>">

    <!-- Cache -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net/" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" as="style" integrity="sha256-wLz3iY/cO4e6vKZ4zRmo4+9XDpMcgKOvv/zEU3OMlRo=" crossorigin="anonymous" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" as="script" integrity="sha256-lSABj6XYH05NydBq+1dvkMu6uiCc/MbLYOFGRkf3iQs=" crossorigin="anonymous" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/all.min.css" as="style" integrity="sha256-Z1K5uhUaJXA7Ll0XrZ/0JhX4lAtZFpT6jkKrEDT0drU=" crossorigin="anonymous" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.11/dist/sweetalert2.all.min.js" integrity="sha256-jdigguLi6jfU4MpneGQwiKMuuRlSmNmdJTw2e4VDHPc=" crossorigin="anonymous" as="script" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous" as="script" />

    <!-- Style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha256-wLz3iY/cO4e6vKZ4zRmo4+9XDpMcgKOvv/zEU3OMlRo=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/all.min.css" integrity="sha256-Z1K5uhUaJXA7Ll0XrZ/0JhX4lAtZFpT6jkKrEDT0drU=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito&display=swap">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha256-lSABj6XYH05NydBq+1dvkMu6uiCc/MbLYOFGRkf3iQs=" crossorigin="anonymous"></script>
</body>

</html>