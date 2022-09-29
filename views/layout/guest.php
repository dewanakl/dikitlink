<?php parents('layout/app') ?>

<?php section('main') ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-lg-6">
            <div class="d-md-flex d-sm-none d-none align-items-center justify-content-center" style="height: 100vh;">
                <img src="<?= asset($img) ?>" class="img-fluid">
            </div>
        </div>
        <div class="col-md-8 col-lg-6">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <?= content('guest') ?>
            </div>
        </div>
    </div>
</div>

<?php endsection('main') ?>