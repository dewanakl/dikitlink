<?= extend('auth/templates/baseTop', ['title' => 'Tersesat...']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-lg-6">
            <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh !important;">
                <div class="row">
                    <h1 class="col-12 h1 text-primary fw-bold" style="font-size:70px;">
                        Link tidak ada
                    </h1>
                    <p class="col-12 text-dark fw-bold" style="font-size: 20px;">
                        Coba teliti lagi, karena ini sangat sensitif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-6">
            <div class="d-md-flex d-sm-none d-none justify-content-center align-items-center" style="min-height: 100vh !important;">
                <img src="<?= asset('404.svg') ?>" alt="404" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<?= extend('auth/templates/baseDown') ?>