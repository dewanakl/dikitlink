<?php parents('email/app') ?>

<?php section('main') ?>

<h3>Haii <strong><?= e($nama) ?></strong></h3>
<p>Berikut link untuk pemulihan akun kamu :</p>

<p><a href="<?= $link ?>" style="color: #126dff;" target="_blank" rel="noopener noreferrer"><?= e($link) ?></a></p>
<p>Link reset password ini satu kali pakai, jika ini bukan kamu maka abaikan saja.</p>

<?php endsection('main') ?>