<?php parents('layout/guest', ['title' => 'Hilang', 'img' => '404.svg']) ?>

<?php section('guest') ?>

<div class="row">
    <div class="col-auto mx-auto">
        <img src="<?= asset('404.svg') ?>" style="width: 65%;" class="d-block d-md-none img-fluid mx-auto">
    </div>
    <div class="col-md-9 col-lg-8 mx-auto">
        <h1 class="fw-bold text-primary mt-5 mb-4" style="font-size: 2.3rem">
            Ada yang nggak betul nich...
        </h1>
        <p class="text-dark fw-bold" style="font-size: 1.2rem;">
            Kamu tersesat. Coba teliti lagi linknya, karena ini sangat sensitif
        </p>
    </div>
</div>

<?php endsection('guest') ?>