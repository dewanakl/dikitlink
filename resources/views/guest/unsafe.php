<?php parents('layout/guest', ['title' => 'Tidak aman', 'img' => 'unsafe.svg']) ?>

<?php section('guest') ?>

<p class="fw-bold text-danger mb-3" style="font-size: 2.3rem">Ada yang nggak aman nich...</p>
<p class="text-dark fw-bold" style="font-size: 1.2rem">Maaf, link yang anda akses terindikasi berbahaya.</p>

<?php endsection('guest') ?>