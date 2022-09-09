<?= extend('auth/templates/top', ['title' => 'Tersesat...', 'img' => '404.svg']) ?>

<div class="container">
    <div class="row">
        <div class="col-auto mx-auto">
            <img src="<?= asset('404.svg') ?>" width="200" class="d-block d-md-none img-fluid ">
        </div>
        <div class="col-md-9 col-lg-8 mx-auto">
            <h1 class="fw-bold text-primary mt-5 mb-4">
                Ada yang nggak betul nich...
            </h1>
            <p class="text-dark fw-bold" style="font-size: 20px;">
                Anda tersesat. Coba teliti lagi linknya, karena ini sangat sensitif
            </p>
        </div>
    </div>
</div>

<?= extend('auth/templates/down') ?>