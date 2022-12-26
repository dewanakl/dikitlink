<?php parents('layout/app') ?>

<?php section('main') ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="d-md-flex d-sm-none d-none align-items-center justify-content-center" style="height: 100vh;">
                <img src="<?= asset($img) ?>" loading="lazy" width="400" class="img-fluid">
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="container">
                    <div class="row">
                        <div class="col-auto mx-auto mb-3">
                            <img src="<?= asset($img) ?>" loading="lazy" style="width: 65%;" class="d-block d-md-none img-fluid mx-auto">
                        </div>
                        <div class="col-md-12 col-lg-9 col-xl-8 mx-auto">
                            <?= content('guest') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endsection('main') ?>