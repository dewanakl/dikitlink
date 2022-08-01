<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="index, follow, noodp" name="robots" />
    <meta content="Dikit-Link simple and powerfull shortlink" name="description" />
    <meta content="Shortlink, pemendek-url, pemendek, url" name="keywords" />
    <meta property="og:title" content="Dikit-Link simple and powerfull shortlink">
    <meta property="og:description" content="Dikit-Link simple and powerfull shortlink">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= asset('/') ?>">
    <title><?= $title ?? 'Kamu Framework' ?></title>
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <link rel="manifest" href="<?= asset('manifest.webmanifest') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= asset('icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="256x256" href="<?= asset('icon-256x256.png') ?>">
    <link rel="icon" type="image/png" sizes="384x384" href="<?= asset('icon-384x384.png') ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?= asset('icon-512x512.png') ?>">
    <link rel="preconnect" href="<?= asset('/') ?>" />
    <link rel="preconnect" href="https://cdnjs.cloudflare.com/" crossorigin="anonymous" />
    <link rel="preconnect" href="https://cdn.jsdelivr.net/" crossorigin="anonymous" />
    <link rel="preload" href="<?= asset('css/app.css') ?>" as="style">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" as="style" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous" as="script" />
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css" integrity="sha512-R+xPS2VPCAFvLRy+I4PgbwkWjw1z5B5gNDYgJN5LfzV4gGNeRQyVrY7Uk59rX+c8tzz63j8DeZPLqmXvBxj8pA==" crossorigin="anonymous" as="style" />
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/solid.min.css" integrity="sha512-EvFBzDO3WBynQTyPJI+wLCiV0DFXzOazn6aoy/bGjuIhGCZFh8ObhV/nVgDgL0HZYC34D89REh6DOfeJEWMwgg==" crossorigin="anonymous" as="style" />
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.all.min.js" integrity="sha256-Tn7eZhp9hdAfPMZi/rV4rBB21f9sKU/oE4WM8ru62nA=" crossorigin="anonymous" as="script" />
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.min.js" integrity="sha512-zjlf0U0eJmSo1Le4/zcZI51ks5SjuQXkU0yOdsOBubjSmio9iCUp8XPLkEAADZNBdR9crRy3cniZ65LF2w8sRA==" crossorigin="anonymous" as="script" />
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css" integrity="sha512-R+xPS2VPCAFvLRy+I4PgbwkWjw1z5B5gNDYgJN5LfzV4gGNeRQyVrY7Uk59rX+c8tzz63j8DeZPLqmXvBxj8pA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/solid.min.css" integrity="sha512-EvFBzDO3WBynQTyPJI+wLCiV0DFXzOazn6aoy/bGjuIhGCZFh8ObhV/nVgDgL0HZYC34D89REh6DOfeJEWMwgg==" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.all.min.js" integrity="sha256-Tn7eZhp9hdAfPMZi/rV4rBB21f9sKU/oE4WM8ru62nA=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.min.js" integrity="sha512-zjlf0U0eJmSo1Le4/zcZI51ks5SjuQXkU0yOdsOBubjSmio9iCUp8XPLkEAADZNBdR9crRy3cniZ65LF2w8sRA==" crossorigin="anonymous"></script>
</head>

<body>