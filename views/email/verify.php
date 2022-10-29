<?php parents('email/app') ?>

<?php section('main') ?>

<h3>Haii <strong><?= e($nama) ?></strong></h3>
<p>Berikut link untuk verifikasi akun kamu :</p>

<p><a href="<?= $link ?>" style="color: #126dff;" target="_blank" rel="noopener noreferrer"><?= e($link) ?></a></p>
<p>Link verifikasi ini satu kali pakai.</p>

<?php endsection('main') ?>